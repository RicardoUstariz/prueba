<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Withdrawal;
use App\Models\Settings;

class ProcesoRetiro extends Component
{
    public $withdrawalId;

    public function mount($withdrawalId)
    {
        $this->withdrawalId = $withdrawalId;
    }

    public function render()
    {
        $settings = Settings::select('theme')->find(1);
        $withdrawal = Withdrawal::find($this->withdrawalId);
        
        return view("{$settings->theme}.livewire.user.deposit.proceso-retiro", ['withdrawal' => $withdrawal]);
    }
}
