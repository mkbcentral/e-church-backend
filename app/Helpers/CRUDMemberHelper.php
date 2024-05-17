<?php

namespace App\Helpers;

use App\Models\Member;

class CRUDMemberHelper
{
    /**
     * Create new member
     * @param array $inputs
     * @return Member
     */
    public static function create(array $inputs): Member
    {
        return Member::create($inputs);
    }

    /**
     * Update member
     * @param Member $member
     * @param array $inputs
     * @return bool
     */
    public static function update(Member $member, array $inputs): bool
    {
        return $member->update($inputs);
    }

    /**
     * get spécific member
     * @param string $id
     * @return Member
     */
    public static  function  getMember(string $id):Member
    {
        return Member::find($id);
    }

    /**
     * Delete member
     * @param Member $member
     * @return bool
     */
    public  static  function delete(Member $member):bool
    {
        return $member->delete();
    }

}
