<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class AuthController extends Controller
{
    //Handle authentications

    public function AdminLogin(Request $request)
    {
        
           
            //dd($departement);
            if (Auth::guard('web')->attempt(['login' => $request->login, 'password' => $request->password, ])) 
            {
                
                // Authentication was successful...
                //dd(Auth::guard('admin')->attempt(['pseudo' => $request->login, 'password' => $request->pass, ]));
                
                $request->session()->regenerate();//regeneger la session

                //dd(auth()->user()->nom);
                return redirect()->intended(route('home'));
               
    
            }
            return back()->with('error', 'login or password incorrect');
        
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();
     
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();

        //dd(session('pseudo'));
        return  redirect()->route('login');
    }

}
