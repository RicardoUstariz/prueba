<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Deposit;
use App\Models\Settings;

class ProcesoDeposito extends Component
{
    public $depositId;

    public function mount($depositId)
    {
        $this->depositId = $depositId;
    }

    public function render()
    {
        $settings = Settings::select('theme')->find(1);
        $deposit = Deposit::find($this->depositId);
        
        return view("{$settings->theme}.livewire.user.deposit.proceso-deposito", ['deposit' => $deposit]);
    }
}
