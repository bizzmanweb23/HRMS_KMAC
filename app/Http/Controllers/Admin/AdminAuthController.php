<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;
use DB;

class AdminAuthController extends Controller
{
    
     
    public function index()
    {
        return view('admin.login');
    }
 
    public function login_check(Request $request)
    { 
        $email = $request->email;
        $password = $request->password;
        $request->validate(
            [
                 
                'email'=>'required',
                'password'=>'required',
                 
            ],

            [
                'email.required'=>'Please Enter Email',
                'password.required'=>'Please Enter Password',
            ]
        ); 
        $userinfo = User::where('email','=',$email)->first();

        if(!$userinfo){
           return back()->with('status','login Failed');
        }
        else {
            if(Hash::check($request->password, $userinfo->password))
            {    
                $request->session()->put('LOGIN', $userinfo->email); 
                return redirect('/dashboard'); 
                
            } else {
                return back()->with('status','Invalid Credentials');
            } 
        }  
    }

    public function register()
    {
        return view('admin.register');
    }

    public function register_new(Request $request)
    {   

        $password = $request->password;
        $confirm = $request->confirm_password;

        $request->validate(
            [
                 
                'email'=>'required|unique:admin',
                'password'=>'required',
                'confirm_password'=>'required',
            ],
            [
                'email.required'=>'Please Enter Email',
                'password.required'=>'Please Enter Password',
            ]
        ); 


        if($password == $confirm)
        {
             
            $data = [
                'name'=> $request->username,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),
            ];

            User::create($data); 
            return redirect()->route('admin.login');
        }

        else 
        { 
            return back()->with('passError','Password Does not match !');
        } 
        
    }   
  
    public function logout(Request $request)
    {
		 
        if(session()->has('LOGIN')){
            session()->pull('LOGIN');
            return redirect('/login');
        }
        return redirect('/login');
    }
    
        
}