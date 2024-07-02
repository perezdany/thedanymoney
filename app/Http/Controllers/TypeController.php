<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Type;

class TypeController extends Controller
{
    //handle types

    public function AllTypes()
    {
        $get = Type::all();

        return $get;
    }
}
