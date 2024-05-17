<?php

namespace App\Livewire\Forms;

use App\Helpers\CRUDDepositHelper;
use App\Models\Deposit;
use Livewire\Attributes\Validate;
use Livewire\Form;

class DepositForm extends Form
{
    #[Validate('required', message: "Montant obligatore")]
    #[Validate('numeric', message: "Format numérique invalide")]
    public string $amount;
    #[Validate('required', message: "Dévise obligatore")]
    public string $currency_id;
    #[Validate('required', message: "Category obligatore")]
    public string $category_deposit_id;
    #[Validate('required', message: "Date création obligatore")]
    #[Validate('date', message: "Format date invalide")]
    public string $created_at;

    public function save(string $memberId): Deposit
    {
        $inputs = [
            'amount' => $this->amount,
            'member_id' => $memberId,
            'currency_id' => $this->currency_id,
            'category_deposit_id' => $this->category_deposit_id,
            'created_at' => $this->created_at,
        ];
        return CRUDDepositHelper::create($inputs);
    }

    public function update(Deposit $deposit): bool
    {
        $inputs = [
            'amount' => $this->amount,
            'currency_id' => $this->currency_id,
            'category_deposit_id' => $this->category_deposit_id,
            'created_at' => $this->created_at,
        ];
        return CRUDDepositHelper::update($deposit, $inputs);
    }
}
