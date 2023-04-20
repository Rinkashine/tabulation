<?php

namespace App\Http\Livewire\Report;

use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class AccountVerificationReport extends Component
{
    public function render()
    {
        $nonverified = Customer::all()->where('email_verified_at','=','')->count();
        $verified = Customer::all()->where('email_verified_at','!=','')->count();
        // dd($verified);
        return view('livewire.report.account-verification-report',[
            'nonverified' => $nonverified,
            'verified'=> $verified
        ]);
    }
}
