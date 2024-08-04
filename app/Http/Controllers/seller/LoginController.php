<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show_login_view(){
        // dd('hh');
        return view('seller.auth.login');
    }
    public function login(Request $request){

        $validated = $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

                  

        if(Auth::guard('seller')->attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
            return redirect()->route('seller')->with('success','you are login ');
        }
        return back()->withInput($request->only('email'));
        // if(Auth::guard('admin')->attempt(['email' =>$request->input('email') , 'password'=>$request->input('password')])){
        //    return redirect()->route('admin')->with('success','you are login ');
        // }
 return $request->all();
        // return back()->withInput($request->only('email'));
    }
}
