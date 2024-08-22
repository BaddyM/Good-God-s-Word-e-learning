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
                    users.lname as lname,
                    users.fname as fname
                FROM
                    courses
                LEFT JOIN
                    materials
                ON
                    courses.id = materials.course_id
                LEFT JOIN
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
                    users.lname as lname,
                    users.fname as fname
                FROM
                    courses
                LEFT JOIN
                    materials
                ON
                    courses.id = materials.course_id
                LEFT JOIN
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
            ->addColumn("size", function ($data) {
                //Convert to MBs
                if ($data->material != null) {
                    $mbs = ((filesize(public_path("materials/$data->id/$data->material"))) / (1024 * 1024));
                    return number_format($mbs, 2) . " MBs";
                }
            })
            ->addColumn("users",function($data){
                return ucfirst($data->lname." ".$data->fname);
            })
            ->addColumn("action", function ($data) {
                $action = "";
                $action .= "
                        <div>
                            <button class='btn border-0 btn-sm rounded-5 btn-outline-danger delete_course' title='Delete Course' data-id='" . $data->id . "'><i class='fa fa-trash'></i></button>
                        </div>
                    ";
                return "<div class='text-center'>$action</div>";
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
                    $material = "-";
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
        try {
            if ($req->filename != null) {
                if ($req->filename->extension() == "mp4") {
                    $type = "video";
                } else {
                    $type = "image";
                }
                $filename = Str::random(16) . "." . $req->filename->extension();
            } else {
                $filename = null;
                $type = null;
            }

            //Save to DB
            DB::table("courses")->insert([
                'title' => $courseName,
                'level' => $level,
                'tutor' => $tutor,
                'description' => $desc,
                'created_at' => now()
            ]);

            //Get the latest course id
            $course_id = DB::table("courses")->select("id")->latest("created_at")->value("id");

            DB::table("materials")->insert([
                'course_id' => $course_id,
                'material' => $filename,
                'type' => $type,
                'created_at' => now()
            ]);

            //Add to the folder            
            if ($req->filename != null) {
                //Check if the folder exists
                $exists = file_exists(public_path("materials/$course_id"));
                if ($exists != 1) {
                    mkdir(public_path("materials/$course_id"), 0777, true);
                    $req->filename->move(public_path("materials/$course_id"), $filename);
                } else {
                    $req->filename->move(public_path("materials/$course_id"), $filename);
                }
            }
            $response = "Course Uploaded Successfully";
        } catch (Exception $e) {
            $response = "Failed, Video too Large or Try Again!";
        }
        return response($response);
    }

    public function delete_course(Request $req)
    {
        $id = $req->id;
        try {
            //Delete file
            $material = DB::table("materials")->select("material")->where("course_id", $id)->value("material");
            //Delete File
            unlink(public_path("materials/$id/$material"));
            //Delete Directory
            rmdir(public_path("materials/$id"));
            //Delete from Courses
            DB::table("courses")->where("id", $id)->delete();
            //Delete from Materials
            DB::table("materials")->where("course_id", $id)->delete();
            $response = "Delete Successfull";
        } catch (Exception $e) {
            $response = "Failed to Delete, Try Again!";
        }
        return response($response);
    }
}
