<?php

namespace App\Http\Controllers;

use App\Models\Admin\AdminAuthController;
use Illuminate\Http\Request;

class AdminAuthControllerController extends Controller
{
     
    public function index()
    {
        return view('admin.login');
    }

     
    public function register()
    {
        return view('admin.register');
    }

    public function signup(Request $request)
    {
        print "<pre>";
        print_r($request->all());
        print_r(Admin::all());
        exit();
    }
   
    public function store(Request $request)
    {
        $request->validate(
            [
                'email'     => 'required|email',
                'password'  => 'required'
            ],
            [
                'email.required'    => 'Please Enter Email Address',
                'password.required' => "Please Enter Password"
            ]
        );

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()
                ->intended(route('admin.dashboard.index'));
        }

        return $this->loginFailed();
    }

     
}
