<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserController extends Controller
{
    //

    public function AddUser(Request $request)
    {
        $pseudo = $request->login;
        $user_password = Hash::make($request->password);

        $Insert = User::create([
            'login' => $pseudo,
            'password' => $user_password,
        ]);

        return back()->with('success', 'ok');
    }
}
