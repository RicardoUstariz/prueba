<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Wdmethod;
use App\Models\Withdrawal;
use App\Mail\NewNotification;
use App\Notifications\AccountNotification;
use App\Traits\PingServer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\Tp_Transaction;

class ManageWithdrawalController extends Controller
{
    use PingServer;

    //process withdrawals
    public function pwithdrawal($id)
    {
        //confirm the users plan
        $withdrawl = Withdrawal::where('id', $id)->first();
        $user = User::where('id', $withdrawl->user)->first();
        //get settings 
        $settings = Settings::where('id', '=', '1')->first();

        if ($withdrawl->user == $user->id) {
            
            $saldo = floatval($user->account_bal) + floatval($withdrawl->amount);

            $user->account_bal = $saldo;
            $user->save();

            //update withdrawal status
            $withdrawl->status = 'Processed';
            $withdrawl->save();

            Tp_Transaction::create([
                'user' => $withdrawl->user,
                'plan' => "",
                'amount' => $withdrawl->amount,
                'type' => "Retiro",
            ]);
        }

        //return redirect()->back()->with('success', 'Action Sucessful!');

        //return redirect()->route('mwithdrawals');

        return redirect()->route('admin.dashboard');
    }

    public function processwithdraw($id)
    {
        $with = Withdrawal::where('id', $id)->first();
        $method = Wdmethod::where('name', $with->payment_mode)->first();
        $user = User::where('id', $with->user)->first();
        return view('admin.withdrawals.pwithrdawal', [
            'withdrawal' => $with,
            'method' => $method,
            'user' => $user,
            'title' => 'Process withdrawal Request',
        ]);
    }

    public function delwithdrawal($id)
    {
        
        Withdrawal::where('id', $id)->delete();

        //return redirect()->back()->with('success', 'Deposit history has been deleted!');

        return redirect()->route('mwithdrawals');
    }

    public function updatestatuswithdrawal($id)
    {
        //confirm the users plan
        $withdrawal = Withdrawal::where('id', $id)->first();
        
        $withdrawal->status = 'Processing';
        $withdrawal->save();

        return redirect()->route('datawithdrawal', $id);
    }

    public function datawithdrawal($id)
    {

        $withdrawal = Withdrawal::where('id', $id)->first();
        $user = User::where('id', $withdrawal->user)->first();

        $datos_bancarios = DB::table('datos_bancarios')->where('retiro_id', $id)->first();

        return view('admin.withdrawals.datosretiro')
            ->with(array(
                'title' => 'Datos del retiro',
                'withdrawal' => $withdrawal,
                'user' => $user,
                'datos_bancarios' => $datos_bancarios,
            ));
    }
}
