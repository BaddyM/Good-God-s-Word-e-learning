<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;

class StudentController extends Controller
{
    public function home()
    {
        return view("student.landing");
    }

    public function courses()
    {
        $courses = DB::table("courses")
            ->select(
                "courses.id as course_id",
                "courses.title as course_title",
                "courses.level as course_level",
                "courses.tutor as course_tutor",
                "courses.description as course_description",
                "level.level as level",
                "level.price as level_price",
                "users.lname as lname",
                "users.fname as fname"
            )
            ->leftJoin("level", "level.id", "=", "courses.level")
            ->leftJoin("users", "courses.tutor", "=", "users.id")
            ->get();
        $enrollment = DB::table("enrollment")->where("student_id", Auth::user()->id)->get();
        $levels = DB::table("level")->get();
        return view("student.courses", compact("courses", 'levels', 'enrollment'));
    }

    public function check_course_materials($level)
    {
        $level_exists = DB::table("level")->where("level", $level)->exists();
        if ($level_exists == 1) {
            $status = DB::table("enrollment")->where(["course_level" => $level])->value("status");
            $price = DB::table("level")->where("level", $level)->value("price");
            $pay_status = DB::table("enrollment")->where(["course_level" => $level])->value("pay_status");
            $course = DB::select("
                    SELECT
                        courses.id as course_id, 
                        courses.title as course_title,
                        courses.level as course_level, 
                        courses.tutor as course_tutor,
                        courses.description as course_description,
                        users.lname as lname,
                        users.fname as fname, 
                        materials.material, 
                        materials.type,
                        materials.length as length,
                        enrollment.pay_code as pay_code
                    FROM
                        courses
                    INNER JOIN
                        users
                    ON
                        users.id = courses.tutor
                    INNER JOIN
                        materials
                    ON
                        materials.course_id = courses.id
                    INNER JOIN
                        enrollment
                    ON
                        enrollment.course_level = courses.level
                    WHERE
                        enrollment.course_level = '" . $level . "'
                ");
            $view = view("student.course_materials", compact("level", "status", "price", "pay_status", "course"));
        } else {
            $view = abort(404);
        }
        return $view;
    }

    //Complete the Course
    public function complete_course(Request $req)
    {
        $level = $req->level;
        $std_id = Auth::user()->id;
        try {
            DB::table("enrollment")->where(["student_id" => $std_id, "course_level" => $level])->update([
                'status' => 'complete'
            ]);
            $response = "Course Completed Successfully";
            $status = 200;
        } catch (Exception $e) {
            info($e);
            $response = "Course Incomplete!";
            $status = 500;
        }
        return response()->json([
            "response" => $response,
            "status" => $status
        ]);
    }

    public function save_course_to_db($std_id, $level, $amount, $pay_method)
    {
        DB::table("enrollment")->insert([
            'student_id' => $std_id,
            'course_level' => $level,
            'paid' => $amount,
            'payment_method' => $pay_method,
            'pay_code' => Str::random(30),
            'created_at' => now()
        ]);
    }

    public function enroll_for_course(Request $req)
    {
        $level = $req->course_level;
        $std_id = DB::table("users")->where(["id" => Auth::user()->id, 'is_student' => 1])->value("id");
        $pay_method = strtolower($req->payment_method);
        $amount = intval(str_replace(",", "", $req->amount));
        $level_complete_counter = DB::table("enrollment")->where(["status" => "complete", "student_id" => $std_id])->count("student_id");
        $check_enrollment = DB::select("
                                SELECT
                                    GROUP_CONCAT(student_id) as student_id,
                                    GROUP_CONCAT(course_level) as course_level
                                FROM 
                                    enrollment
                                WHERE
                                    student_id = '" . $std_id . "'
                            ")[0]->course_level;
        if ($check_enrollment == null) {
            //Enroll for the first time
            if ($level == 1) {
                if ($std_id != null && $level == 1 && $amount != null && $pay_method != null) {
                    $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                    $response = "Level enrollment successsfull";
                    $status = 200;
                } else {
                    $response = "Something went wrong!";
                    $status = 401;
                }
            } else {
                $response = "You must enroll for Level 1 first";
                $status = 401;
            }
        } else {
            //If already enrolled before
            if ($std_id != null && $level > 1 && $amount != null && $pay_method != null) {
                switch ($level) {
                    case 2:
                        if ($level_complete_counter == 1) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 1 first";
                            $status = 401;
                        }
                        break;
                    case 3:
                        if ($level_complete_counter == 2) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 2 first";
                            $status = 401;
                        }
                        break;
                    case 4:
                        if ($level_complete_counter == 3) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 3 first";
                            $status = 401;
                        }
                        break;
                    case 5:
                        if ($level_complete_counter == 4) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 4 first";
                            $status = 401;
                        }
                        break;
                    case 6:
                        if ($level_complete_counter == 5) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 5 first";
                            $status = 401;
                        }
                        break;
                    case 7:
                        if ($level_complete_counter == 6) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 6 first";
                            $status = 401;
                        }
                        break;
                    case 8:
                        if ($level_complete_counter == 7) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 7 first";
                            $status = 401;
                        }
                        break;
                    case 9:
                        if ($level_complete_counter == 8) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 8 first";
                            $status = 401;
                        }
                        break;
                    case 10:
                        if ($level_complete_counter == 9) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 9 first";
                            $status = 401;
                        }
                        break;
                    case 11:
                        if ($level_complete_counter == 10) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 10 first";
                            $status = 401;
                        }
                        break;
                    case 12:
                        if ($level_complete_counter == 11) {
                            //Previous level is complete
                            $this->save_course_to_db($std_id, $level, $amount, $pay_method);
                            $response = "Enrollment for level $level successfull, please wait for confirmation";
                            $status = 200;
                        } else {
                            //Level previous incomplete
                            $response = "Please complete level 11 first";
                            $status = 401;
                        }
                        break;
                    default:
                        $response = "Something went wrong, try again!";
                        $status = 401;
                        break;
                }
            } else {
                $response = "All fields must be filled";
                $status = 401;
            }
        }

        return response()->json([
            'response' => $response,
            'status' => $status
        ]);
    }

    public function password_index()
    {
        return view("student.password");
    }

    public function profile_index()
    {
        $data = DB::table("users")->select("*")->where("id", Auth::user()->id)->first();
        return view("student.profile", compact("data"));
    }

    public function edit_profile(Request $req)
    {
        $lname = strtolower($req->lname);
        $fname = strtolower($req->fname);
        $email = strtolower($req->email);
        $gender = strtolower($req->gender);
        $image = $req->user_img;
        $current_img = DB::table('users')->select("image")->where("id", Auth::user()->id)->value("image");
        try {
            if ($image != null) {
                $filename = Str::random(16) . "." . $req->user_img->extension();
                if ($current_img == "blank.png") {
                    //Add image to directory
                    $req->user_img->move(public_path("users"), $filename);
                } else {
                    //Delete the current image
                    unlink(public_path("users/" . $current_img . ""));

                    //Add new image
                    $req->user_img->move(public_path("users"), $filename);
                }

                //Save to DB
                DB::table('users')->where("id", Auth::user()->id)->update([
                    "lname" => $lname,
                    "fname" => $fname,
                    "email" => $email,
                    "gender" => $gender,
                    "image" => $filename
                ]);
            } else {
                $filename = null;
                DB::table('users')->where("id", Auth::user()->id)->update([
                    "lname" => $lname,
                    "fname" => $fname,
                    "email" => $email,
                    "gender" => $gender
                ]);
            }
            $response = "Update successfull";
        } catch (Exception $e) {
            info($e);
            $response = "Sorry, something went wrong!";
        }
        return response()->json([
            "message" => $response,
            "image" => $filename
        ]);
    }
}
