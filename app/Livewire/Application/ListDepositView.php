<?php

namespace App\Livewire\Application;

use App\Models\Deposit;
use Livewire\Component;

class ListDepositView extends Component
{
    public $created_at;

    public function mount()
    {
        $this->created_at = date('Y-m-d');
    }

    public function render()
    {
        return view('livewire.application.list-deposit-view', [
            'deposits' => Deposit::whereDate('created_at', $this->created_at)->get()
        ]);
    }
}
