<?php

namespace App\Livewire\Application\Finance\Form;

use App\Livewire\Forms\DepositForm;
use App\Models\CategoryDeposit;
use App\Models\Currency;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateDepositView extends Component
{
    protected $listeners = [
        'memberEmitted' => 'getMemeber'
    ];

    public DepositForm $form;

    public ?Member $memberDeposit;

    public function getMemeber(Member $member)
    {
        $this->memberDeposit = $member;
    }
    public function save()
    {
        $this->validate();
        $this->form->save($this->memberDeposit->id);
        session()->flash('message', 'Membre bien ajouté');
    }
    public function mount()
    {
        $this->form->created_at = date('Y-m-d');
    }
    public function render()
    {
        return view('livewire.application.finance.form.create-deposit-view', [
            'categories' => CategoryDeposit::where('church_id', Auth::user()->church->id)->get(),
            'currencies' => Currency::all(),
        ]);
    }
}
