<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;
class StudentController extends Controller
{
    public function home(){
        return view("student.landing");
    }

    public function courses(){
        $courses = DB::table("courses")
                ->select("courses.id as course_id", "courses.title as course_title",
                "courses.level as course_level", "courses.tutor as course_tutor",
                "courses.description as course_description", "level.level as level",
                "level.price as level_price", "users.lname as lname",
                "users.fname as fname")
                ->leftJoin("level","level.id","=","courses.level")
                ->leftJoin("users","courses.tutor","=","users.id")
                ->get();
        $enrollment = DB::table("enrollment")->where("student_id", Auth::user()->id)->get();
        $levels = DB::table("level")->get();
        return view("student.courses", compact("courses", 'levels', 'enrollment'));
    }

    public function courses_enrolled($pay_code){
        $courses = DB::select("
            SELECT
                courses.id as course_id, 
                courses.title as course_title,
                courses.level as course_level, 
                courses.tutor as course_tutor,
                courses.description as course_description,
                users.lname as lname,
                users.fname as fname, 
                materials.material, materials.type,
                enrollment.pay_code as pay_code
            FROM
                courses
            LEFT JOIN
                users
            ON
                users.id = courses.tutor
            LEFT JOIN
                materials
            ON
                materials.course_id = courses.id
            LEFT JOIN
                enrollment
            ON
                enrollment.course_id = courses.id
            WHERE
                enrollment.pay_code = '".$pay_code."'
        ");
        return view("student.enrolled", compact("courses"));
    }

    //Complete the Course
    public function complete_course(Request $req){
        $pay_code = $req->code;
        try{
            DB::table("enrollment")->where("pay_code",$pay_code)->update([
                'status' => 'complete'
            ]);
            $response = "Course Completed Successfully";
        }catch(Exception $e){
            $response = "Course Incomplete!";
        }
        return response($response);
    }

    public function course_enroll($id){
        $course = DB::table("courses")
                    ->select("courses.id as course_id", "courses.title as course_title",
                    "courses.level as course_level", "courses.tutor as course_tutor",
                    "courses.description as course_description", "level.level as level",
                    "level.price as level_price", "users.lname as lname",
                    "users.fname as fname","enrollment.status as enroll_status",
                    "enrollment.paid as paid", "enrollment.pay_status")
                    ->leftJoin("level","level.id","=","courses.level")
                    ->leftJoin("users","courses.tutor","=","users.id")
                    ->leftJoin("enrollment","enrollment.course_id","=","courses.id")
                    ->where("courses.id",$id)
                    ->first();
        return view("student.enroll", compact("course"));
    }

    public function enroll_for_course(Request $req){
        $course_id = $req->course_id;
        $level = $req->course_level;
        $std_id = DB::table("users")->where(["id" => Auth::user()->id, 'is_student' => 1])->value("id");
        $pay_method = strtolower($req->payment_method);
        $amount = intval(str_replace(",","",$req->amount));
        $level_status = DB::table("enrollment")->where(["status" => "incomplete", "student_id" => $std_id])->exists();
        if($level_status != 1){
            if($pay_method != null){
                if($std_id != null){
                    //Enroll for Course
                    $exists = DB::table("enrollment")->where(['course_id' => $course_id, 'student_id' => $std_id, 'course_level' => $level])->exists();
                    if($exists != 1){
                        //Save to DB
                        try{
                            DB::table("enrollment")->insert([
                                'course_id' => $course_id,
                                'student_id' => $std_id,
                                'course_level' => $level,
                                'paid' => $amount,
                                'payment_method' => $pay_method,
                                'pay_code' => Str::random(30),
                                'created_at' => now()
                            ]);
                            $response = "Course Enroll Succesfull, Wait For Confirmation";
                            $status = 200;
                        }catch(Exception $e){
                            info($e);
                            $response = "Failed to Enroll For Course!";
                            $status = 500;
                        }
                    }else{
                        $response = "Course Awaiting Confirmation!";
                        $status = 401;
                    }
                }else{
                    $response = "Not a Student Account!";
                    $status = 401;
                }
            }else{
                $response = "Select Payment Method!";
                $status = 401;
            }
        }else{
            $response = "There is an Incomplete Course!";
            $status = 401;
        }

        return response()->json([
            'response' => $response,
            'status' => $status
        ]);
    }

    public function password_index(){
        return view("student.password");
    }

    public function profile_index(){
        $data = DB::table("users")->select("email","lname","fname")->where("id",Auth::user()->id)->first();
        return view("student.profile",compact("data"));
    }
}
