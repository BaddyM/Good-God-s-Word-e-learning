<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;

class TutorController extends Controller
{
    public function courses_index()
    {
        return view("tutor.courses");
    }

    public function courses_data()
    {
        if (Auth::user()->is_admin == 1) {
            $data = DB::select("
                SELECT
                    courses.id as id,
                    courses.title as title,
                    courses.level as level,
                    courses.description as description,
                    materials.material as material,
                    materials.created_at as created_at,
                    materials.type as type,
                    materials.length as length,
                    users.lname as lname,
                    users.fname as fname
                FROM
                    courses
                INNER JOIN
                    materials
                ON
                    courses.id = materials.course_id
                INNER JOIN
                    users
                ON
                    users.id = courses.tutor
                ORDER BY
                    id DESC
            ");
        } else {
            $data = DB::select("
                SELECT
                    courses.id as id,
                    courses.title as title,
                    courses.level as level,
                    courses.description as description,
                    materials.material as material,
                    materials.created_at as created_at,
                    materials.type as type,
                    materials.length as length,
                    users.lname as lname,
                    users.fname as fname
                FROM
                    courses
                INNER JOIN
                    materials
                ON
                    courses.id = materials.course_id
                INNER JOIN
                    users
                ON
                    users.id = courses.tutor
                WHERE
                    courses.tutor = '" . Auth::user()->id . "'
                ORDER BY
                    id DESC
            ");
        }

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn("title", function ($data) {
                return strtoupper($data->title);
            })
            ->editColumn("description", function ($data) {
                return ucfirst($data->description);
            })
            ->addColumn("length", function ($data) {
                $hours = explode(":",$data->length)[0];
                $mins = explode(":",$data->length)[1];
                $length = $hours." hour(s) : ".$mins." minutes";
                return $length;
            })
            ->addColumn("users", function ($data) {
                return ucfirst($data->lname . " " . $data->fname);
            })
            ->addColumn("action", function ($data) {
                $action = "";
                $action .= "
                            <button 
                                class='btn border-0 btn-sm rounded-5 btn-outline-success update_course' 
                                title='Update Course' 
                                data-id='" . $data->id . "'
                                data-title='".$data->title."'
                                data-description='".$data->description."'
                                data-material='".$data->material."'
                                data-hours='".explode(":",$data->length)[0]."'
                                data-mins='".explode(":",$data->length)[1]."'
                                data-level='".$data->level."'
                            ><i class='fa fa-pen'></i></button>
                    ";

                $action .= "
                        <button class='btn border-0 btn-sm rounded-5 btn-outline-danger delete_course' title='Delete Course' data-id='" . $data->id . "'><i class='fa fa-trash'></i></button>
                ";
                return "<div class='text-center d-block'>$action</div>";
            })
            ->editColumn("material", function ($data) {
                if ($data->type == 'image') {
                    $material = "
                            <img style='width:200px; height:200px; object-fit:contain;' src='/materials/$data->id/$data->material'>
                        ";
                } elseif ($data->type == 'video') {
                    $material = "
                            <video style='width:200px; height:200px; object-fit:contain;' controls src='/materials/$data->id/$data->material'></video>
                        ";
                } else {
                    $material = '<div class="course_video_admin">
                                    <iframe style="width:200px; height:200px;" class="img-fluid course_video"
                                    src="https://www.youtube.com/embed/'.$data->material.'" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                    <div class="d-none oncontextmenu="return false;"></div>
                                </div>';
                }
                return $material;
            })
            ->editColumn("created_at", function ($data) {
                return date("D, d M, Y h:i a", strtotime($data->created_at));
            })
            ->rawColumns(['action', 'material'])
            ->make(true);
    }

    public function add_course(Request $req)
    {
        $courseName = strtolower($req->course_name);
        $level = $req->level;
        $desc = strtolower($req->description);
        $tutor  = Auth::user()->id;
        $check_link = count(explode("/",$req->link));
        $period = (($req->hours == null?0:intval($req->hours)).":".($req->minutes == null?0:intval($req->minutes)));
        
        try {
            if($check_link == 4 && strlen(explode("/",$req->link)[3]) == 11){
                $link = explode("/",$req->link)[3];
                if ($req->filename != null) {
                    if ($req->filename->extension() == "mp4") {
                        $type = "video";
                    } else {
                        $type = "image";
                    }
                    $filename = Str::random(16) . "." . $req->filename->extension();
                } else {
                    $filename = $link;
                    $type = "link";
                }
    
                //Save to Courses DB
                DB::table("courses")->insert([
                    'title' => $courseName,
                    'level' => $level,
                    'tutor' => $tutor,
                    'description' => $desc,
                    'created_at' => now()
                ]);
    
                //Get the latest course id
                $course_id = DB::table("courses")->select("id")->latest("created_at")->value("id");
    
                //Add to materials DB
                DB::table("materials")->insert([
                    'course_id' => $course_id,
                    'material' => $filename,
                    'type' => $type,
                    "length" => $period,
                    'created_at' => now()
                ]);
                $response = "Course Uploaded Successfully";
            }else{
                $response = "Invalid youtube link used";
            }
        } catch (Exception $e) {
            info($e);
            $response = "Something went wrong, Try again!";
        }
        return response($response);
    }

    public function delete_course(Request $req)
    {
        $id = $req->id;
        try {
            //Delete file
            $material = DB::table("materials")->select("material")->where("course_id", $id)->value("material");
            //Check if file exists
            $file_exists = public_path("materials/$id/$material");
            if ($file_exists == 1) {
                //Delete File
                unlink(public_path("materials/$id/$material"));
                //Delete Directory
                rmdir(public_path("materials/$id"));
                //Delete from Courses
                DB::table("courses")->where("id", $id)->delete();
            }
            //Delete from Materials
            DB::table("materials")->where("course_id", $id)->delete();
            $response = "Delete Successfull";
        } catch (Exception $e) {
            $response = "Failed to Delete, Try Again!";
        }
        return response($response);
    }

    public function update_course(Request $req){
        $course_id = $req->id;
        $course_name = $req->course_name;
        $desc = $req->description;
        $level = $req->level;
        $hours = $req->hours;
        $mins = $req->minutes;
        $link = $req->link;
        $length = $hours.":".$mins;

        try{
            //Update the Course Table
            DB::table("courses")->where("id",$course_id)->update([
                "title" => $course_name,
                "level" => $level,
                "description" => $desc
            ]);

            //Update the Materials Table
            DB::table("materials")->where("course_id",$course_id)->update([
                "material" => $link,
                "length" => $length
            ]);

            $response = "Update successfull";
        }catch(Exception $e){
            info($e);
            $response = "Sorry, something went wrong!";
        }
        return response($response);
    }
}
