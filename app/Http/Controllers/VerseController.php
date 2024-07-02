<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class VerseController extends Controller
{
    //

    public function CountVerse()
    {

        $numb_verse = DB::table('verses')->count();

        return $numb_verse;
    }

    public function GetVerseById($id)
    {

        $the_verse = DB::table('verses')->where('id', $id)->get();

        return $the_verse;
    }
}
