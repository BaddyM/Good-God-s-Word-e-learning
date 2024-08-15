<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login_index(){
        return view("login.login");
    }

    public function register_index(){
        return view("login.register");
    }

    public function forgot_password_index(){
        return view("login.forgot_password");
    }
}
