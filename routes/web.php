<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

include("custom/student_routes.php");

//Root Routes
Route::get("/",function(){
    return view("root");
});

//Login Routes
Route::get("/Login",[LoginController::class,'login_index'])->name("login");

//Register Routes
Route::get("/Register",[LoginController::class,'register_index'])->name("register");

//Forgot Password Routes
Route::get("/ForgotPassword",[LoginController::class,'forgot_password_index'])->name("forgot.password");
