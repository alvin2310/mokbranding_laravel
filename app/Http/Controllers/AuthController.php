<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showlogin(){
        return view('login');
    }
    public function login(Request $request){
        // dd($request->all());
        $data = User::where('email',$request->email)->firstOrFail();
        if($data){
            if(Hash::check($request->password, $data->password)){
                return redirect('/');
            }
        }
        return redirect('/login')->with('message','Email atau Password salah');
    }
}
