<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;

include("custom/student_routes.php");
include("custom/tutor_routes.php");
include("custom/system_routes.php");

/*
//Root Routes
Route::get("/",function(){
    return view("root");
});
*/

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
Route::get("/ResetPassword/{id}",[LoginController::class,'reset_password_index'])->name("reset.password.index");
Route::post("/ResetPasswordLink",[LoginController::class,'reset_password_link'])->name("reset.password.link");
Route::post("/ConfirmResetPassword",[LoginController::class,'confirm_reset_password'])->name("user.reset.password");

//Website
Route::get("/",[WebsiteController::class,'home'])->name("home.index");
Route::get("/About",[WebsiteController::class,'about'])->name("about.index");
Route::get("/OurCourses",[WebsiteController::class,'courses'])->name("courses.website.index");
Route::get("/Team",[WebsiteController::class,'team'])->name("team.index");
Route::get("/ContactUs",[WebsiteController::class,'contact'])->name("contact.index");
