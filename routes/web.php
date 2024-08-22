<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

include("custom/student_routes.php");
include("custom/tutor_routes.php");
include("custom/system_routes.php");

//Root Routes
Route::get("/",function(){
    return view("root");
});

//Login Routes
Route::get("/Login",[LoginController::class,'login_index'])->name("login");
Route::post("/AuthenticateUser",[LoginController::class,'login_user'])->name("login.auth");
Route::post("/Logout",[LoginController::class,'logout'])->name("logout");
Route::post("/PasswordUpdate",[LoginController::class,'update_password'])->name("update.password");

//Register Routes
Route::get("/Register",[LoginController::class,'register_index'])->name("register");
Route::post("/RegisterUser",[LoginController::class,'register_user'])->name("register.user");
Route::get("/VerifyEmail/{id}",[LoginController::class,'verify_email'])->name("email.verify");

//Forgot Password Routes
Route::get("/ForgotPassword",[LoginController::class,'forgot_password_index'])->name("forgot.password");
