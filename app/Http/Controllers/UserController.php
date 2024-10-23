<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

use DB;

class UserController extends Controller
{
    //

    public function AddUser(Request $request)
    {
        $nom = $request->nom;
        $pseudo = $request->login;
        $user_password = Hash::make($request->password);

        $Insert = User::create([
            'nom' => $nom,
            'login' => $pseudo,
            'password' => $user_password,
        ]);

        return back()->with('success', 'Done!');
    }

    public function EditUser(Request $request)
    {
        $nom = $request->nom;
        $pseudo = $request->login;
 
        $affected = DB::table('users')
        ->where('id', '=', $request->id)
        ->update([
            'nom' => $nom,
            'login' => $pseudo,
       ]);

       return  redirect('welcome')->with('success', 'Done');


    }

    public function EditPass(Request $request)
    {
       
        $user_password = Hash::make($request->password);

        $affected = DB::table('users')
        ->where('id', '=', $request->id)
        ->update([
            'password' => $user_password,
                
        ]);

       return redirect('welcome')->with('success', 'Done');
    }

    public function GoProfile(Request $request)
    {
         //dd($request->id_user);
        return view('profile',
            [
                'id_user' => $request->id_user,
                
            ]
         );
    }

    public function GetById($id)
    {
        return User::where('id', $id)->get();
    }
}
