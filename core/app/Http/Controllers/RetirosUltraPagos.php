<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Settings;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use App\Models\Tp_Transaction;

class RetirosUltraPagos extends Controller
{
    
    public function store(Request $request)
    {
        
        $settings = Settings::select('theme')->find(1);

        $dateString = date('Y-m-d H:i:s', strtotime('+3 minutes'));
        $user = Auth::user();

        $dp = new Withdrawal();
        $dp->amount = $request['amount'];
        $dp->payment_mode = $request['payment_mode'];
        $dp->status = 'Pending';
        $dp->user = $user->id;
        $dp->expires_at = $dateString;
        $dp->save();

        DB::table('datos_bancarios')->insert([
            'tipo_cuenta' => $request['account-type'],
            'numero_cuenta' => $request['account-number'],
            'cedula' => $request['id-number'],
            'celular_cliente' => $request['client-phone'],
            'deposito_id' => '',
            'retiro_id' => $dp->id,
        ]);

        return redirect()->route('retiro', $dp->id);
        //return redirect()->route('dashboard');
    }
}
