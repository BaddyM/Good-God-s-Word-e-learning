<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function home(){
        return view("student.landing");
    }
    public function courses(){
        return view("student.courses");
    }
    public function courses_enrolled($id){
        return view("student.enrolled");
    }
    public function course_enroll($id){
        return view("student.enroll");
    }

    public function password_index(){
        return view("student.password");
    }
    public function profile_index(){
        return view("student.profile");
    }
}
