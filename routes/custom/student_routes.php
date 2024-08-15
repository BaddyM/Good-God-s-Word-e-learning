<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

//Student Routes
Route::prefix("Student")->group(function () {
    Route::get('/Home', [StudentController::class, 'home'])->name('home');
    Route::get('/Courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/Course/{id}', [StudentController::class, 'courses_enrolled'])->name('courses.enrolled');
    Route::get('/EnrollCourse/{id}', [StudentController::class, 'course_enroll'])->name('course.enroll');
    Route::get('/UpdatePassword', [StudentController::class, 'password_index'])->name('password.index');
    Route::get('/Profile', [StudentController::class, 'profile_index'])->name('profile.index');
});
