<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Deposit;
use App\Models\Wdmethod;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositStatus;
use App\Traits\TemplateTrait;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use FPDF;

class DepositController extends Controller
{
    use TemplateTrait;

    public function getmethod($id)
    {
        $methodname = Wdmethod::where('id', $id)->first();
        return response()->json($methodname->name);
    }

    //Return payment page
    public function newdeposit(Request $request)
    {
        $settings = Settings::where('id', '1')->first();
        $methodname = Wdmethod::where('name', $request->payment_method)->first();

        if ($methodname->name == "Credit Card" and $settings->credit_card_provider == "Stripe") {

            $secretkey = $settings->s_s_k;
            $zero = '00';
            $amt = $request->amount . $zero;

            \Stripe\Stripe::setApiKey($secretkey);
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amt,
                'currency' => strtolower($settings->s_currency),
                'payment_method_types' => ['card'],
                'description' => 'Funding My Account',
                'shipping' => [
                    'name' => Auth::user()->name,
                    'address' => [
                        'line1' => 'No Address',
                        'postal_code' => '000000',
                        'city' => 'No City',
                        'state' => 'CA',
                        'country' => 'US',
                    ],
                ],
                'metadata' => ['integration_check' => 'accept_a_payment'],
            ]);

            $client_secret = $paymentIntent->client_secret;
        } else {
            $client_secret = "";
        }


        //store payment info in session
        $request->session()->put('amount', $request['amount']);
        $request->session()->put('payment_mode', $methodname->name);
        $request->session()->put('intent', $client_secret);

        return redirect()->route('payment');
    }

    //payment route
    public function payment(Request $request)
    {
        $settings = Settings::select('theme')->find(1);
        // {$settings->theme}.
        $methodname = Wdmethod::firstWhere('name', $request->session()->get('payment_mode'));
        return view("{$settings->theme}.user.payment")
            ->with(array(
                'amount' => $request->session()->get('amount'),
                'payment_mode' => $methodname,
                'intent' => $request->session()->get('intent'),
                'title' => 'Make Payment',
            ));
    }

    public function cancelPayment(): RedirectResponse
    {
        return redirect()->route('deposits')->with('message', 'Payment Cancelled');
    }

    public function savestripepayment(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();

        //get settings 
        $settings = Settings::where('id', '=', '1')->first();
        $earnings = $settings->referral_commission * $request->amount / 100;


        //save and confirm the deposit
        $dp = new Deposit();
        $dp->amount = $request->amount;
        $dp->payment_mode = "Stripe";
        $dp->status = 'Processed';
        $dp->proof = "Credit Card";
        $dp->plan = 0;
        $dp->user = $user->id;
        $dp->save();

        if ($settings->deposit_bonus != NULL and $settings->deposit_bonus > 0) {
            $bonus = $request->amount * $settings->deposit_bonus / 100;
            //create history
            Tp_Transaction::create([
                'user' => $user->id,
                'plan' => "Deposit Bonus for $settings->currency $request->amount deposited",
                'amount' => $bonus,
                'type' => "Bonus",
            ]);
        } else {
            $bonus = 0;
        }

        //add funds to user's account
        User::where('id', $user->id)
            ->update([
                'account_bal' => $user->account_bal + $request->amount + $bonus,
                'bonus' => $user->bonus + $bonus,
                'cstatus' => 'Customer',
            ]);

        if (!empty($user->ref_by)) {

            $agent = User::where('id', $user->ref_by)->first();
            User::where('id', $user->ref_by)
                ->update([
                    'account_bal' => $agent->account_bal + $earnings,
                    'ref_bonus' => $agent->ref_bonus + $earnings,
                ]);

            //credit commission to ancestors
            $users = User::all();
            $this->getAncestors($users, $request->amount, $user->id);

            Tp_Transaction::create([
                'user' => $user->ref_by,
                'plan' => "Credit",
                'amount' => $earnings,
                'type' => "Ref_bonus",
            ]);
        }

        //Send confirmation email to user regarding his deposit and it's successful.
        Mail::to($user->email)->send(new DepositStatus($dp, $user, 'Successful Deposit', false));

        // delete the session variables
        $request->session()->forget('payment_mode');
        $request->session()->forget('amount');
        $request->session()->forget('intent');

        return response()->json(['success' => 'Payment Completed, redirecting']);
    }

    //Save deposit requests
    public function savedeposit(Request $request)
    {

        $this->validate($request, [
            'proof' => ['required', 'mimes:jpg,jpeg,png,pdf', 'max:3000'],
        ]);

        $settings = Settings::where('id', '=', '1')->first();

        if ($request->hasfile('proof')) {
            $file = $request->file('proof');
            $extension = $file->extension();
            $whitelist = array('pdf', 'jpeg', 'jpg', 'png');

            if (in_array($extension, $whitelist)) {
                $path = $file->store('uploads', 'public');
            } else {
                return redirect()->back()
                    ->with('message', 'Unaccepted Image Uploaded');
            }
        }

        $dp = new Deposit();
        $dp->amount = $request['amount'];
        $dp->payment_mode = $request['paymethd_method'];
        $dp->status = 'Pending';
        $dp->proof = $path;
        $dp->user = Auth::user()->id;
        $dp->save();

        //get user
        $user = User::where('id', Auth::user()->id)->first();

        //Send Email to admin regarding this deposit
        Mail::to($settings->contact_email)->send(new DepositStatus($dp, $user, 'Successful Deposit', true));

        //Send confirmation email to user regarding his deposit and it's successful.to get a response back from admin
        Mail::to($user->email)->send(new DepositStatus($dp, $user, 'Successful Deposit', false));

        // Kill the session variables
        $request->session()->forget('payment_mode');
        $request->session()->forget('amount');

        return redirect()->route('deposits')
            ->with('success', 'Account Fund Sucessful! Please wait for system to validate this transaction.');
    }

    //Get uplines
    function getAncestors($array, $deposit_amount, $parent = 0, $level = 0)
    {
        $referedMembers = '';
        $parent = User::where('id', $parent)->first();

        foreach ($array as $entry) {
            if ($entry->id == $parent->ref_by) {
                //get settings 
                $settings = Settings::where('id', '=', '1')->first();

                if ($level == 1) {
                    $earnings = $settings->referral_commission1 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 2) {
                    $earnings = $settings->referral_commission2 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 3) {
                    $earnings = $settings->referral_commission3 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 4) {
                    $earnings = $settings->referral_commission4 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                } elseif ($level == 5) {
                    $earnings = $settings->referral_commission5 * $deposit_amount / 100;
                    //add earnings to ancestor balance
                    User::where('id', $entry->id)
                        ->update([
                            'account_bal' => $entry->account_bal + $earnings,
                            'ref_bonus' => $entry->ref_bonus + $earnings,
                        ]);

                    //create history
                    Tp_Transaction::create([
                        'user' => $entry->id,
                        'plan' => "Credit",
                        'amount' => $earnings,
                        'type' => "Ref_bonus",
                    ]);
                }

                if ($level == 6) {
                    break;
                }

                //$referedMembers .= '- ' . $entry->name . '- Level: '. $level. '- Commission: '.$earnings.'<br/>';
                $referedMembers .= $this->getAncestors($array, $deposit_amount, $entry->id, $level + 1);
            }
        }
        return $referedMembers;
    }

    public function deposito($id)
    {
        $settings = Settings::select('theme')->find(1);

        $deposit = Deposit::where('id', $id)->first();

        $deposits = Deposit::where('expires_at', '>', Carbon::now())
            ->where('status', 'Pending')
            ->latest()
            ->take(10)
            ->get();

        if ($deposit == null) {
            return redirect()->route('dashboard');
        }

        return view("{$settings->theme}.user.datosdeposito")->with(array(
            'deposit' => $deposit,
            'deposits' => $deposits,
        ));
    }

    public function depositofetch($id)
    {

        $deposit = Deposit::where('id', $id)->first();

        if ($deposit != null) {

            $fechaActual = Carbon::now();

            if ($deposit->expires_at < $fechaActual && $deposit->status != 'Processed') {

                return response()->json(array('status' => 'expited'));
            }
        }

        return response()->json($deposit);
    }

    public function depositofactura($id)
    {

        $deposit = Deposit::where('id', $id)->first();

        if ($deposit == null) {
            return redirect()->route('dashboard');
        }

        // Crear una instancia de FPDF
        $pdf = new FPDF('P', 'mm', [100, 180]);
        $pdf->AddPage();

        // Configurar fuente
        $pdf->SetFont('Arial', 'B', 20);
        //$pdf->Cell(0, 10, utf8_decode('refácil'), 0, 1, 'C');
        //$pdf->Image(public_path('assets/img/logonegro.png'), 20, 0, 60, 15);

        // Descargar la imagen desde la URL
        $imageUrl = 'https://ultra.multipagos.co/assets/img/logonegro.png';
        $imageContent = file_get_contents($imageUrl);
        $tempImagePath = sys_get_temp_dir() . '/temp_image.png';
        file_put_contents($tempImagePath, $imageContent);

        $pdf->Image($tempImagePath, 20, 0, 60, 15);

        // Subtítulo
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'RECIBO DE VENTA', 0, 1, 'C');
        $pdf->Ln(10);

        // Detalles de la venta
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, 'Producto', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, utf8_decode('Desposito ' . $deposit->payment_mode), 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, 'Fecha', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, $deposit->expires_at, 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, utf8_decode('Código'), 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, $deposit->id, 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, utf8_decode('Código proveedor'), 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, $deposit->user, 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, utf8_decode('Número'), 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, $deposit->id, 0, 1);

        $pdf->Ln(10);

        // Valor de venta
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, utf8_decode('Valor venta:'), 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, '$ ' . $deposit->amount, 0, 1);

        // Configurar para la descarga del archivo
        return response()->streamDownload(function () use ($pdf) {
            $pdf->Output('D', 'recibo.pdf'); // El segundo parámetro 'D' es para la descarga
        }, $deposit->id . '-deposito.pdf');
    }
}
