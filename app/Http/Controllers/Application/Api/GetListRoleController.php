<?php

namespace App\Http\Controllers\Application\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Symfony\Component\HttpKernel\Exception\HttpException;

class GetListRoleController extends Controller
{
    public function __invoke()
    {
        try {
            return RoleResource::collection(Role::all());
        } catch (HttpException $ex) {
            return response([
                'error' => $ex->getMessage(),
            ], 500);
        }
    }
}
