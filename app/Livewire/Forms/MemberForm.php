<?php

namespace App\Livewire\Forms;

use App\Helpers\CRUDMemberHelper;
use App\Models\Member;
use Livewire\Attributes\Validate;
use Livewire\Form;

class MemberForm extends Form
{
    #[Validate('required', message: "Nom membre obligatore")]
    public string $name;
    #[Validate('required', message: "Date de naissance obligatore")]
    #[Validate('date', message: "Format date invalide")]
    public string $birthdate;
    #[Validate('required', message: "N° Tél obligatoire")]
    #[Validate('numeric', message: "Format numérique invalide")]
    public string $phone;
    #[Validate('required', message: "N° Tél obligatoire")]
    #[Validate('email', message: "Format email invalide")]
    public string $email;

    public function save(): Member
    {
        $inputs = [
            'name' => $this->name,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'phone' => $this->phone,
            'church_id' => auth()->user()->church->id,
        ];
        return  CRUDMemberHelper::create($inputs);
    }

    public function update(Member $member): bool
    {
        $inputs = [
            'name' => $this->name,
            'birthdate' => $this->birthdate,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
        return CRUDMemberHelper::update($member, $inputs);
    }
}
