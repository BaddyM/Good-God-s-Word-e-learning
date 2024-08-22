<?php

use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Route;

Route::prefix("Tutor")->middleware(['auth','admin-tutor'])->group(function(){
    Route::get("/CourseList",[TutorController::class,'courses_index'])->name("tutor.course");
    Route::post("/CourseData",[TutorController::class,'courses_data'])->name("tutor.course.data");
    Route::post("/AddCourse",[TutorController::class,'add_course'])->name("tutor.course.add");
    Route::post("/DeleteCourse",[TutorController::class,'delete_course'])->name("tutor.course.delete");
});