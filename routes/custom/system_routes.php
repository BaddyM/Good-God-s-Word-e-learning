<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::prefix("Admin")->middleware(['auth','admin'])->group(function(){
    //Enrollment
    Route::get("/Enrollments",[AdminController::class,'enroll_index'])->name("enrollment");
    Route::post("/EnrollmentData",[AdminController::class,'enrollment_data'])->name("enrollment.data");
    Route::post("/AcceptEnrollment",[AdminController::class,'accept_enrollment'])->name("enrollment.accept");
    Route::post("/CancelEnrollment",[AdminController::class,'cancel_enrollment'])->name("enrollment.cancel");

    //Accounts
    Route::get("/Accounts",[AdminController::class,'accounts_list'])->name("accounts.list");
    Route::post("/AccountsList",[AdminController::class,'accounts_list_data'])->name("accounts.list.data");
    Route::post("/ActivateUser",[AdminController::class,'activate_user'])->name("accounts.activate");
    Route::post("/DeactivateUser",[AdminController::class,'deactivate_user'])->name("accounts.deactivate");
    Route::post("/DeleteUser",[AdminController::class,'delete_user'])->name("accounts.delete");
    Route::post("/AddUser",[AdminController::class,'add_account'])->name("accounts.add");

    //Levels
    Route::get("/Levels",[AdminController::class,'levels_index'])->name("levels.index");
    Route::post("/SaveLevels",[AdminController::class,'save_levels'])->name("levels.save");
});