<?php

namespace App\Livewire\Application\Member;

use App\Livewire\Forms\MemberForm;
use App\Models\CategoryDeposit;
use App\Models\Currency;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MemberView extends Component
{
    public  MemberForm $form;
    public ?Member $member, $memberDeposit;
    public bool $isEditing = false;
    public string $formLabel = "CREATION MEMBRE";
    public string $buttonLabel = "Créer...";
    public $search = '';

    public function save()
    {
        $this->validate();
        $this->form->save();
        session()->flash('message', 'Membre bien ajouté');
    }
    public function edit(Member $member)
    {
        $this->form->fill($member->toArray());
        $this->member = $member;
        $this->isEditing = true;
        $this->formLabel = "MODIFICATION MEMBRE";
        $this->buttonLabel = "MODIFIER";
    }
    public function update()
    {
        $this->form->update($this->member);
        session()->flash('message', 'Membre bien modofié');
    }

    public function delete(Member $member)
    {
        $member->delete();
        session()->flash('message', 'Membre bien retité');
    }

    public function newDeposit(Member $member)
    {
        $this->dispatch('memberEmitted', $member);
    }

    public function render()
    {
        return view('livewire.application.member.member-view', [
            'members' => Member::where('name', 'like', "%" . $this->search . "%")->get(),
        ]);
    }
}
