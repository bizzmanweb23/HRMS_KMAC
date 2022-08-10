<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function profile()
    {
        return view('Admin.User.profile');
    }
    public function edit_profile()
    {
        return view('Admin.User.edit-profile');
    }
}
