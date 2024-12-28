<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Exception;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function accounts_list(){
        return view("system.accounts");
    }

    public function accounts_list_data(){
        $data = DB::table("users")->select("id","lname","fname",
        "gender","is_tutor","is_student",
        "is_admin","is_active","email_verified",
        "email","created_at")
        ->get();
        return DataTables::of($data)
                ->addColumn("priviledge",function($data){
                    if($data->is_admin == 1){
                        $priviledge = "<span class='badge bg-primary'>admin</span>";
                    }elseif($data->is_student == 1){
                        $priviledge = "<span class='badge bg-warning text-dark'>student</span>";
                    }elseif($data->is_tutor == 1){
                        $priviledge = "<span class='badge bg-success'>tutor</span>";
                    }else{
                        $priviledge = "<span class='badge bg-secondary'>other</span>";
                    }
                    return $priviledge;
                })
                ->addColumn("user",function($data){
                    return ucfirst($data->lname." ".$data->fname);
                })
                ->addColumn("status",function($data){
                    if($data->is_active == 1){
                        $status = "<div class='alert alert-success p-1 border border-success mb-0'>active</div>";
                    }else{
                        $status = "<div class='alert alert-secondary p-1 border border-secondary mb-0'>inactive</div>";
                    }
                    return $status;
                })
                ->editColumn("created_at",function($data){
                    return date("D, d M, Y h:i a",strtotime($data->created_at));
                })
                ->addColumn("action",function($data){
                    $action = "";
                    if($data->id != 1){
                        //Check  Account Active Status
                        if($data->is_active == 0){
                            $action .= "<div>
                                <button title='Activate' class='btn btn-sm btn-outline-success rounded-5 activate_user' data-id='".$data->id."'><i class='fa fa-check'></i></button>
                            </div>";
                        }else{
                            $action .= "<div>
                                <button title='Deactivate' class='btn btn-sm btn-danger rounded-5 deactivate_user' data-id='".$data->id."'><i class='fa fa-x'></i></button>
                            </div>";
                        }

                        //Delete Account
                        $action .= "<div>
                            <button title='Delete' class='btn btn-sm btn-outline-danger rounded-5 delete_user' data-id='".$data->id."'><i class='fa fa-trash'></i></button>
                        </div>";
                    }
                    return "<div class='d-flex justify-content-center' style='gap:5px;'>$action</div>";
                })
                ->rawColumns(['action','priviledge','status'])
                ->addIndexColumn()
                ->make(true);
    }

    public function activate_user(Request $req){
        $id = $req->id;
        if($id != 1){
            try{
                DB::table("users")->where("id",$id)->update([
                    'is_active' => 1,
                    'email_verified' => 1
                ]);
                $response = "Account Activated";
            }catch(Exception $e){
                $response = "Failed to Activate Account,Try Again!";
            }
        }else{
            $response = "Invalid ID";
        }
        return response($response);
    }

    public function deactivate_user(Request $req){
        $id = $req->id;
        if($id != 1){
            try{
                DB::table("users")->where("id",$id)->update([
                    'is_active' => 0,
                    'email_verified' => 0
                ]);
                $response = "Account Deactivated";
            }catch(Exception $e){
                $response = "Failed to Deactivate Account,Try Again!";
            }
        }else{
            $response = "Invalid ID";
        }
        return response($response);
    }

    public function delete_user(Request $req){
        $id = $req->id;
        if($id != 1){
            DB::table("users")->where("id",$id)->delete();
            $response = "Account Deleted Successfully";
        }else{
            $response = "Invalid ID";
        }
        return response($response);
    }

    public function add_account(Request $req){
        $lname = strtolower($req->lname);
        $fname = strtolower($req->fname);
        $email = strtolower($req->email);
        $gender = strtolower($req->gender);
        $account_type = strtolower($req->account_type);
        $password = Hash::make($req->password);
        $exists = DB::table("users")->where("email",$email)->exists();
        if($exists != 1){
            try{
                if($account_type == "admin"){
                    DB::table("users")->insert([
                        'lname' => $lname,
                        'fname' => $fname,
                        'gender' => $gender,
                        'email' => $email,
                        'is_admin' => 1,
                        'password' => $password,
                        'created_at' => now()
                    ]);
                }elseif($account_type == "student"){
                    DB::table("users")->insert([
                        'lname' => $lname,
                        'fname' => $fname,
                        'gender' => $gender,
                        'email' => $email,
                        'is_student' => 1,
                        'password' => $password,
                        'created_at' => now()
                    ]);
                }elseif($account_type == "tutor"){
                    DB::table("users")->insert([
                        'lname' => $lname,
                        'fname' => $fname,
                        'gender' => $gender,
                        'email' => $email,
                        'is_tutor' => 1,
                        'password' => $password,
                        'created_at' => now()
                    ]);
                }else{
                    $response = "Invalid Credentials";
                }
                $response = "Account Added Successfully";
            }catch(Exception $e){
                $response = "Failed, Try Again!";
            }
        }else{
            $response = "Email Already Exists!";
        }        
        return response($response);
    }

    //Enrollment
    public function enroll_index(){
        return view("system.enrollment");
    }

    public function enrollment_data(){
        $data = DB::select("
            SELECT
                users.lname as lname,
                users.fname as fname,
                users.email as email,
                enrollment.course_level as level,
                enrollment.status as level_status,
                enrollment.pay_status as status,
                enrollment.payment_method as method,
                enrollment.created_at as created_at,
                enrollment.id as id,
                enrollment.paid as paid
            FROM
                enrollment
            LEFT JOIN
                users
            ON
                users.id = enrollment.student_id
            ORDER BY 
                enrollment.id
            DESC
        ");

        return DataTables::of($data)
                ->addColumn("name",function($data){
                    $name = "<div style='cursor:pointer;' title='".$data->email."'>".ucfirst($data->lname)." ".ucfirst($data->fname)."</div>";
                    return $name;
                })
                ->addColumn("paid",function($data){
                    return number_format($data->paid,0);
                })
                ->addColumn("level_status",function($data){
                    if($data->level_status == "complete"){
                        $status = "<div class='badge bg-success'>".$data->level_status."</div>";
                    }else{
                        $status = "<div class='badge bg-danger'>".$data->level_status."</div>";
                    }
                    return $status;
                })
                ->addColumn("method",function($data){
                    return strtoupper($data->method);
                })
                ->addColumn("status",function($data){
                    if($data->status == 'pending'){
                        $status = "<div class='alert alert-danger p-1 mb-0 text-uppercase h6 fw-bold'>pending</div>";
                    }elseif($data->status == 'confirmed'){
                        $status = "<div class='alert alert-success p-1 mb-0 text-uppercase h6 fw-bold'>confirmed</div>";
                    }else{
                        $status = "<div class='alert alert-danger p-1 mb-0 text-uppercase h6 fw-bold'>cancelled</div>";
                    }
                    return $status;
                })
                ->editColumn("created_at",function($data){
                    return date("D, d M, Y h:i a",strtotime($data->created_at));
                })
                ->addColumn("action",function($data){
                    $action = "";

                    if($data->status == 'pending' || $data->status == 'cancelled'){
                        $action .= "
                        <div>
                            <button title='Accept' class='btn btn-sm btn-outline-success rounded-5 accept_enrollment' data-id='".$data->id."'><i class='fa fa-check'></i></button>
                        </div>";
                    }elseif($data->status == 'confirmed'){
                        $action .= "
                        <div>
                            <button title='Cancel' class='btn btn-sm btn-danger rounded-5 cancel_enrollment' data-id='".$data->id."'><i class='fa fa-x'></i></button>
                        </div>";
                    }else{
                        $action .= "";
                    }

                    $action .= "
                        <div>
                            <button title='Delete' class='btn btn-sm btn-outline-danger rounded-5 delete_enrollment' data-id='".$data->id."'><i class='fa fa-trash'></i></button>
                        </div>";

                    return "<div class='d-flex justify-content-center' style='gap:5px;'>$action</div>";
                })
                ->rawColumns(['action','status','level_status','name'])
                ->addIndexColumn()
                ->make(true);
    }

    public function accept_enrollment(Request $req){
        $id = $req->id;
        DB::table("enrollment")->where("id",$id)->update([
            'pay_status' => 'confirmed'
        ]);
        $response = "Success";
        return response($response);
    }

    public function cancel_enrollment(Request $req){
        $id = $req->id;
        DB::table("enrollment")->where("id",$id)->update([
            'pay_status' => 'cancelled'
        ]);
        $response = "Cancelled";
        return response($response);
    }

    public function levels_index(){
        $levels = DB::table("level")->get();
        return view("system.levels",compact("levels"));
    }

    public function save_levels(Request $req){
        $price = $req->price;
        for($i=1; $i<=12; $i++){
            if($price[$i-1] != null){
                try{
                    DB::table("level")->where("id",$i)->update([
                        "price" => intval($price[$i-1])
                    ]);
                    $response = "Level prices saved";
                }catch(Exception $e){
                    $response = "Something went wrong, try again!";
                }
            }
        }
        return response($response);
    }

    public function delete_enrollment(Request $req){
        $id = $req->id;
        try{
            DB::table("enrollment")->where("id",$id)->delete();
            $response = "Delete successfull";
        }catch(Exception $e){
            $response = "Sorry, something went wrong!";
        }
        return response($response);
    }
}
