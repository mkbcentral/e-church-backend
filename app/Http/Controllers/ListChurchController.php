<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChurchResource;
use App\Models\Church;

class ListChurchController extends Controller
{
    public function getListChurches()
    {
        return  ChurchResource::collection(Church::orderBy('created_at', 'desc')->get());
    }
}
