<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Models\User;

class Notificaciones extends Component
{

    public function loadMessages()
    {
        $the_deposits = array();

        $deposits = Deposit::where('expires_at', '>', Carbon::now())
            ->where('status', 'Pending')
            ->orderBy('created_at', 'desc') // Ordenar por la columna deseada
            ->take(10)
            ->get();

        $i = 0;

        foreach ($deposits as $deposit) {
            $user = User::where('id', $deposit->user)->first();

            $datos = array(
                'user' => $user,
                'deposit' => $deposit,
            );

            $the_deposits[$i] = $datos;
            $i++;
        }

        $the_withdrawals = array();

        $withdrawals = Withdrawal::where('expires_at', '>', Carbon::now())
            ->where('status', 'Pending')
            ->orderBy('created_at', 'desc') // Ordenar por la columna deseada
            ->take(10)
            ->get();

        $i = 0;

        foreach ($withdrawals as $withdrawal) {
            $user = User::where('id', $withdrawal->user)->first();

            $datos = array(
                'user' => $user,
                'withdrawal' => $withdrawal,
            );

            $the_withdrawals[$i] = $datos;
            $i++;
        }

        $this->deposits = $the_deposits;
        $this->withdrawals = $the_withdrawals;
    }

    public function render()
    {

        $this->loadMessages();  // Carga mensajes al renderizar inicialmente
        return view('livewire.notificaciones');
    }
}
