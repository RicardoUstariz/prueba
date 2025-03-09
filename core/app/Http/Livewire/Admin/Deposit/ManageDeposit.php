<?php

namespace App\Http\Livewire\Admin\Deposit;

use App\Mail\DepositStatus;
use App\Models\Deposit;
use App\Models\Settings;
use App\Models\Tp_Transaction;
use App\Models\User;
use App\Notifications\AccountNotification;
use App\Services\ReferralCommisionService;
use App\Traits\PingServer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class ManageDeposit extends Component
{
    use WithPagination;
    use PingServer;

    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $order = 'desc';
    public $status = 'All';
    public $perPage = 10;
    public $toDate = '';
    public $fromDate = '';
    public $deleteId = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];


    public function render()
    {

        $deposits = Deposit::ofSearch($this->search)
            ->ofStatus($this->status)
            ->orderBy('id', $this->order)
            ->with('duser:id,name')
            ->ofDate($this->fromDate, $this->toDate)
            ->where(function ($query) {
                $query->where('status', '!=', 'Pending')
                    ->orWhere(function ($query) {
                        $query->where('status', 'Pending')
                            ->where('expires_at', '>=', Carbon::now());
                    });
            })
            ->whereIn('status', ['Pending', 'Processed'])
            ->latest()
            ->paginate($this->perPage);

        return view('livewire.admin.deposit.manage-deposit', [
            //'deposits' => Deposit::ofSearch($this->search)->ofStatus($this->status)->orderBy('id', $this->order)->with('duser:id,name')->ofDate($this->fromDate, $this->toDate)->paginate($this->perPage),
            'deposits' => $deposits,
        ]);
    }


    //reset all filter
    public function resetFilter()
    {
        $this->reset(['search', 'order', 'status', 'perPage', 'toDate', 'fromDate']);
    }

    public function deleteId($id)
    {
        $this->deleteId = $id;
    }

    // delete deposit record 
    public function delete()
    {
        $deposit = Deposit::findOrFail($this->deleteId);
        try {
            if (!empty($deposit->proof) && Storage::disk('public')->exists($deposit->proof)) {
                Storage::disk('public')->delete($deposit->proof);
            }
            $deposit->delete();
            session()->flash('success', 'Deposit deleted successfully!');
        } catch (\Throwable $th) {
            session()->flash('error', 'Something went wrong!, deposit does not exist.');
        }
    }

    //process deposits
    public function confirmDeposit(int $id)
    {
        //confirm the users plan
        $deposit = Deposit::where('id', $id)->first();
        $user = User::where('id', $deposit->user)->first();
        //get settings 
        $settings = Settings::where('id', '=', '1')->first();

        $response = $this->callServer('earnings', '/process-deposit', [
            'referral_commission' => $settings->referral_commission,
            'amount' => $deposit->amount,
            'account_bal' => $user->account_bal,
            'depositBonus' => $settings->deposit_bonus,
        ]);

        if ($response->failed()) {
            session()->flash('message', $response['message']);
        } else {
            $data = json_decode($response);
            $bonus = intval($data->data->bonusToAdd);
            $funds = intval($data->data->funding);

            if ($deposit->user == $user->id) {
                //add funds to user's account
                $user->account_bal = $funds;
                $user->cstatus = 'Customer';
                $user->bonus = $user->bonus + $bonus;
                $user->save();

                if ($bonus != NULL and $bonus > 0) {
                    Tp_Transaction::create([
                        'user' => $user->id,
                        'plan' => "Deposit Bonus for $settings->currency $deposit->amount deposited",
                        'amount' => $bonus,
                        'type' => "Bonus",
                    ]);
                }

                if ($settings->referral_proffit_from == 'Deposit') {
                    // credit referral commission
                    $ref = new ReferralCommisionService($user, $deposit->amount);
                    $ref->run();
                }

                //update deposit status
                $deposit->status = 'Processed';
                $deposit->save();

                //Send notification to user regarding his deposit and it's successful.
                $user->notify(new AccountNotification("Your Deposit have been Confirmed and the amount is added to your account balance. Amount: {$settings->currency}{$deposit->amount}", 'Deposit is Confirmed'));

                //Send confirmation email to user regarding his deposit and it's successful.
                Mail::to($user->email)->send(new DepositStatus($deposit, $user, 'Your Deposit have been Confirmed', false));
            }
            session()->flash('success', 'Deposit confirmed successfully!');
        }
    }
}
