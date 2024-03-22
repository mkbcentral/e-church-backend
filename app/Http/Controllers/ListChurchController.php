<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChurchResource;
use App\Models\Church;
use Illuminate\Http\Request;

class ListChurchController extends Controller
{
    public function getListChurches()
    {
        return  ChurchResource::collection(Church::all());
    }
}
