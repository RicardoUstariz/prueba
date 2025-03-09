<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Deposit;
use App\Models\DatosBancarios;
use App\Models\Wdmethod;
use App\Models\Tp_Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DepositStatus;
use App\Traits\TemplateTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepositosUltraPagos extends Controller
{

    public function store(Request $request)
    {
        
        $settings = Settings::select('theme')->find(1);

        $dateString = date('Y-m-d H:i:s', strtotime('+3 minutes'));

        $dp = new Deposit();
        $dp->amount = $request['amount'];
        $dp->payment_mode = $request['payment_mode'];
        $dp->status = $request['status'];
        $dp->proof = "";
        $dp->plan = 0;
        $dp->user = Auth::user()->id;
        $dp->expires_at = $dateString;
        $dp->save();

        DB::table('datos_bancarios')->insert([
            'tipo_cuenta' => $request['account-type'],
            'numero_cuenta' => $request['account-number'],
            'cedula' => $request['id-number'],
            'celular_cliente' => $request['client-phone'],
            'deposito_id' => $dp->id,
            'retiro_id' => '',
        ]);

        return redirect()->route('deposito', $dp->id);
    }
}
