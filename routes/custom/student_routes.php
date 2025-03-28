<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

//General Routes
Route::prefix("Section")->middleware(["auth"])->group(function () {
    Route::get('/Home', [StudentController::class, 'home'])->name('home');
    Route::get('/UpdatePassword', [StudentController::class, 'password_index'])->name('password.index');
    Route::get('/Profile', [StudentController::class, 'profile_index'])->name('profile.index');
    Route::post('/EditProfile', [StudentController::class, 'edit_profile'])->name('profile.update');

    //Messages
    Route::get('/Messages', [StudentController::class, 'messages_index'])->name('messages.index');
    Route::get('/EmailCounter', [StudentController::class, 'email_counter'])->name('email.counter');
    Route::post('/SendMessage', [StudentController::class, 'send_message'])->name('message.send');
    Route::post('/FetchMessages', [StudentController::class, 'messages_table'])->name('message.fetch');
    Route::post('/ReadMessage', [StudentController::class, 'read_message'])->name('message.read');
    Route::post('/DeleteMessage', [StudentController::class, 'delete_message'])->name('message.delete');
});

//Student Routes
Route::prefix("Student")->middleware(["auth","admin-student"])->group(function () {
    Route::get('/Courses', [StudentController::class, 'courses'])->name('courses');
    Route::get('/CourseMaterials/{level}', [StudentController::class, 'check_course_materials'])->name('course.materials.list');
    Route::get('/Course/{id}', [StudentController::class, 'courses_enrolled'])->name('courses.enrolled');
    Route::get('/EnrollCourse/{id}', [StudentController::class, 'course_enroll'])->name('course.enroll');
    Route::post('/EnrollCourseStart', [StudentController::class, 'enroll_for_course'])->name('course.enroll.start');

    //Complete Course
    Route::post("/CompleteCourse",[StudentController::class,'complete_course'])->name("complete.course");
});
