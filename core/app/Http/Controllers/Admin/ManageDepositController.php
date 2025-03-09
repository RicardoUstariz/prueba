<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Settings;
use App\Models\Deposit;
use App\Models\Tp_Transaction;
use App\Mail\DepositStatus;
use App\Notifications\AccountNotification;
use App\Services\ReferralCommisionService;
use App\Traits\PingServer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ManageDepositController extends Controller
{
    use PingServer;

    //Delete deposit
    public function deldeposit($id)
    {
        $deposit = Deposit::where('id', $id)->first();
        Storage::disk('public')->delete($deposit->proof);
        Deposit::where('id', $id)->delete();

        //return redirect()->back()->with('success', 'Deposit history has been deleted!');

        return redirect()->route('mdeposits');
    }

    //process deposits
    public function pdeposit($id)
    {
        //confirm the users plan
        $deposit = Deposit::where('id', $id)->first();
        $user = User::where('id', $deposit->user)->first();
        //get settings 
        $settings = Settings::where('id', '=', '1')->first();

        if ($deposit->user == $user->id) {
            
            $saldo = floatval($user->account_bal) - floatval($deposit->amount);

            $user->account_bal = $saldo;
            $user->save();

            //update deposit status
            $deposit->status = 'Processed';
            $deposit->save();

            Tp_Transaction::create([
                'user' => $deposit->user,
                'plan' => "",
                'amount' => $deposit->amount,
                'type' => "Deposito",
            ]);
        }

        //return redirect()->back()->with('success', 'Action Sucessful!');

        //return redirect()->route('mdeposits');

        return redirect()->route('admin.dashboard');
    }

    public function updatestatusdeposit($id)
    {
        //confirm the users plan
        $deposit = Deposit::where('id', $id)->first();
        
        $deposit->status = 'Processing';
        $deposit->save();

        return redirect()->route('datadeposit', $id);
    }

    public function datadeposit($id)
    {

        $deposit = Deposit::where('id', $id)->first();
        $user = User::where('id', $deposit->user)->first();

        $datos_bancarios = DB::table('datos_bancarios')->where('deposito_id', $id)->first();

        return view('admin.deposits.datosdeposito')
            ->with(array(
                'title' => 'Datos del deposito',
                'deposit' => $deposit,
                'user' => $user,
                'datos_bancarios' => $datos_bancarios,
            ));
    }
}
