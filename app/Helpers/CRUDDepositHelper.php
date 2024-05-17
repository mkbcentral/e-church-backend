<?php

namespace App\Helpers;

use App\Models\Deposit;

class CRUDDepositHelper
{
    /**
     * Create new Deposit
     * @param array $inputs
     * @return Deposit
     */
    public static function create(array $inputs): Deposit
    {
        return Deposit::create($inputs);
    }

    /**
     * Update Deposit
     * @param Deposit $deposit
     * @param array $inputs
     * @return bool
     */
    public static function update(Deposit $deposit, array $inputs): bool
    {
        return $deposit->update($inputs);
    }

    /**
     * get spécific Deposit
     * @param string $id
     * @return Deposit
     */
    public static  function  getDeposit(string $id): Deposit
    {
        return Deposit::find($id);
    }

    /**
     * Delete Deposit
     * @param Deposit $deposit
     * @return bool
     */
    public  static  function delete(Deposit $deposit): bool
    {
        return $deposit->delete();
    }
}
