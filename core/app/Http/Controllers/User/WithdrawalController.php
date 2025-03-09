<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\User_plans;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\WithdrawalStatus;
use App\Traits\Coinpayment;
use App\Traits\TemplateTrait;

use Carbon\Carbon;
use FPDF;

class WithdrawalController extends Controller
{
    use Coinpayment, TemplateTrait;
    //
    public function withdrawamount(Request $request)
    {
        $request->session()->put('paymentmethod', $request->method);
        return redirect()->route('withdrawfunds');
    }

    //Return withdrawals route
    public function withdrawfunds()
    {
        $settings = Settings::select('theme')->find(1);
        $paymethod = session('paymentmethod');
        $checkmethod =  Wdmethod::where('name', $paymethod)->first();
        if ($checkmethod->defaultpay == "yes") {
            $default = true;
        } else {
            $default = false;
        }

        if ($checkmethod->methodtype == "crypto") {
            $methodtype = 'crypto';
        } else {
            $methodtype = 'currency';
        }

        return view("{$settings->theme}.user.withdraw", [
            'title' => 'Complete Withdrawal Request',
            'payment_mode' => $paymethod,
            'default' => $default,
            'methodtype' => $methodtype,
        ]);
    }

    public function getotp()
    {
        $code = $this->RandomStringGenerator(5);

        $user = Auth::user();
        User::where('id', $user->id)->update([
            'withdrawotp' => $code,
        ]);

        $message = "You have initiated a withdrawal request, use the OTP: $code to complete your request.";
        $subject = "OTP Request";
        Mail::to($user->email)->send(new NewNotification($message, $subject, $user->name));

        return redirect()->back()
            ->with('success', 'Action Sucessful! OTP have been sent to your email');
    }

    public function completewithdrawal(Request $request)
    {

        if (Auth::user()->sendotpemail == "Yes") {
            if ($request->otpcode != Auth::user()->withdrawotp) {
                return redirect()->back()->with('message', 'OTP is incorrect, please recheck the code');
            }
        }

        $settings = Settings::where('id', '1')->first();
        if ($settings->enable_kyc == "yes") {
            if (Auth::user()->account_verify != "Verified") {
                return redirect()->back()->with('message', 'Your account must be verified before you can make withdrawal.');
            }
        }

        $method = Wdmethod::where('name', $request->method)->first();

        if ($method->charges_type == 'percentage') {
            $charges = $request['amount'] * $method->charges_amount / 100;
        } else {
            $charges = $method->charges_amount;
        }

        $to_withdraw = $request['amount'] + $charges;
        //return if amount is lesser than method minimum withdrawal amount

        if (Auth::user()->account_bal < $to_withdraw) {
            return redirect()->back()
                ->with('message', 'Sorry, your account balance is insufficient for this request.');
        }

        if ($request['amount'] < $method->minimum) {
            return redirect()->back()
                ->with("message", "Sorry, The minimum amount you can withdraw is $settings->currency$method->minimum, please try another payment method.");
        }

        //get user last investment package
        User_plans::where('user', Auth::user()->id)
            ->where('active', 'yes')
            ->orderBy('activated_at', 'asc')->first();

        //get user
        $user = User::where('id', Auth::user()->id)->first();

        if ($request->method == 'Bitcoin') {
            if (empty($user->btc_address)) {
                return redirect()->route('profile')
                    ->with('message', 'Please Setup your Bitcoin Wallet Address');
            }
            $coin = "BTC";
            $wallet = $user->btc_address;
        } elseif ($request->method  == 'Ethereum') {
            if (empty($user->eth_address)) {
                return redirect()->route('profile')
                    ->with('message', 'Please Setup your Ethereum Wallet Address');
            }
            $coin = "ETH";
            $wallet = $user->eth_address;
        } elseif ($request->method  == 'Litecoin') {
            if (empty($user->ltc_address)) {
                return redirect()->route('profile')
                    ->with('message', 'Please Setup your Litecoin Wallet Address');
            }
            $coin = "LTC";
            $wallet = $user->ltc_address;
        } elseif ($request->method  == 'USDT') {
            if (empty($user->usdt_address)) {
                return redirect()->route('profile')
                    ->with('message', 'Please Setup your USDT Wallet Address');
            }
            $coin = "USDT.TRC20";
            $wallet = $user->usdt_address;
        } elseif ($request->method  == 'Bank Transfer') {
            if (empty($user->account_name) or empty($user->bank_name) or empty($user->account_number)) {
                return redirect()->route('profile')
                    ->with('message', 'Please Setup your Bank Account Details');
            }
        }

        $amount = $request['amount'];
        $ui = $user->id;

        if ($settings->deduction_option == "userRequest") {
            //debit user
            User::where('id', $user->id)->update([
                'account_bal' => $user->account_bal - $to_withdraw,
                'withdrawotp' => NULL,
            ]);
        }

        if ($settings->withdrawal_option == "auto" and ($request->method == 'Bitcoin' or $request->method  == 'Litecoin' or $request->method  == 'Ethereum' or $request->method == 'USDT')) {
            return $this->cpwithdraw($amount, $coin, $wallet, $ui, $to_withdraw);
        }

        //save withdrawal info
        $dp = new Withdrawal();
        $dp->amount = $amount;
        $dp->to_deduct = $to_withdraw;
        $dp->payment_mode = $request->method;
        $dp->status = 'Pending';
        $dp->paydetails = $request->details;
        $dp->user = $user->id;
        $dp->save();

        // send mail to admin
        Mail::to($settings->contact_email)->send(new WithdrawalStatus($dp, $user, 'Withdrawal Request', true));

        //send notification to user
        Mail::to($user->email)->send(new WithdrawalStatus($dp, $user, 'Successful Withdrawal Request'));

        return redirect()->route('withdrawalsdeposits')
            ->with('success', 'Action Sucessful! Please wait while we process your request.');
    }


    // for front end content management
    function RandomStringGenerator($n)
    {
        $generated_string = "";
        $domain = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $len = strlen($domain);
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, $len - 1);
            $generated_string = $generated_string . $domain[$index];
        }
        // Return the random generated string 
        return $generated_string;
    }

    public function retiro($id)
    {
        $settings = Settings::select('theme')->find(1);

        $withdrawal = Withdrawal::where('id', $id)->first();

        $withdrawals = Withdrawal::where('expires_at', '>', Carbon::now())
            ->where('status', 'Pending')
            ->latest()
            ->take(10)
            ->get();

        if ($withdrawal == null) {
            return redirect()->route('dashboard');
        }

        return view("{$settings->theme}.user.datosretiro")->with(array(
            'withdrawal' => $withdrawal,
            'withdrawals' => $withdrawals,
        ));
    }

    public function retirofetch($id)
    {

        $withdrawal = Withdrawal::where('id', $id)->first();

        if ($withdrawal != null) {

            $fechaActual = Carbon::now();

            if ($withdrawal->expires_at < $fechaActual && $withdrawal->status != 'Processed') {

                return response()->json(array('status' => 'expited'));
            }
        }

        return response()->json($withdrawal);
    }

    public function retirofactura($id)
    {

        $withdrawal = Withdrawal::where('id', $id)->first();

        if ($withdrawal == null) {
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
        $pdf->Cell(0, 10, utf8_decode('Retiro '.$withdrawal->payment_mode), 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, 'Fecha', 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, $withdrawal->expires_at, 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, utf8_decode('Código'), 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, $withdrawal->id, 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, utf8_decode('Código proveedor'), 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, $withdrawal->user, 0, 1);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 10, utf8_decode('Número'), 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 10, $withdrawal->id, 0, 1);

        $pdf->Ln(10);

        // Valor de venta
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(40, 10, utf8_decode('Valor venta:'), 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 10, '$ '.$withdrawal->amount, 0, 1);

        // Configurar para la descarga del archivo
        return response()->streamDownload(function () use ($pdf) {
            $pdf->Output('D', 'recibo.pdf'); // El segundo parámetro 'D' es para la descarga
        }, $withdrawal->id . '-retiro.pdf');
    }
}
