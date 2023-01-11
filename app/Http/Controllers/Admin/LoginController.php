<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show_login_view(){
        return view('admin.auth.login');
    }


    public function login(Request $request){

        $validated = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);


        if(Auth::guard('admin')->attempt(['email' =>$request->input('email') , 'password'=>$request->input('password')])){
           return redirect()->route('admin')->with('success','you are login ');
        }

        return back()->withInput($request->only('email'));
    }

    public function logout(){
        auth()->logout();
        return redirect()->route('admin.showlogin');

    }
}
