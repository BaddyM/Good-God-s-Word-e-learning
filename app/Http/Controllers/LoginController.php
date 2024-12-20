<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Exception;

class LoginController extends Controller
{
    public function login_index()
    {
        return view("login.login");
    }

    public function register_index()
    {
        return view("login.register");
    }

    public function forgot_password_index()
    {
        return view("login.forgot_password");
    }

    public function reset_password_index($id)
    {
        $data = DB::table("users")->where("id", $id)->first();
        return view("login.password_reset", compact("data"));
    }

    public function reset_password_link(Request $req)
    {
        $email = $req->email;
        $email_exists = DB::table("users")->where("email", $email)->exists();
        if ($email_exists == 1) {
            $status = 200;
            $response = "Password reset link sent to email!";

            //Send password reset link
            $id = DB::table("users")->where("email", $email)->value("id");
            $verify_link = route("reset.password.index", $id);
            $message = "Please reset your password here";
            Mail::to($email)->send(new SendMail("Password Reset", $message, $verify_link));
        } else {
            $status = 404;
            $response = "This email does not exist!";
        }

        return response()->json([
            "status" => $status,
            "message" => $response
        ]);
    }

    public function confirm_reset_password(Request $req)
    {
        try {
            $email = $req->email;
            $password = Hash::make($req->password);
            DB::table("users")->where("email", $email)->update([
                "password" => $password
            ]);
            $status = 200;
            $response = "Password reset successfull";
            $link = route("login");
        } catch (Exception $e) {
            $status = 200;
            $response = "Password reset failed!";
            $link = "";
        }
        return response()->json([
            "status" => $status,
            "messasge" => $response,
            "link" => $link
        ]);
    }

    public function login_user(Request $req)
    {
        $email = $req->email;
        $email_verified = DB::table("users")->where("email", $email)->value("email_verified");

        $credentials = $req->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials) && $email_verified == 1) {
            $route = route("home");
            $response = "Login Successfull";
            $status = 200;
        } elseif ($email_verified != 1) {
            $route = null;
            $response = "Email not Verified!";
            $status = 401;
        } else {
            $route = null;
            $response = "Email or Password is Incorrect!";
            $status = 401;
        }
        return response()->json([
            'route' => $route,
            'response' => $response,
            'status' => $status
        ]);
    }

    public function register_user(Request $req)
    {
        $lname = strtolower($req->lname);
        $fname = strtolower($req->fname);
        $email = strtolower($req->email);
        $full_name = "$lname $fname";
        $pass1 = strtolower($req->password);
        $pass2 = strtolower($req->confirm_password);
        $gender = $req->gender;
        $exists = DB::table("users")->where("email", $email)->exists();
        if ($pass1 == $pass2) {
            if ($exists != 1) {
                //Insert into the DB
                DB::table("users")->insert([
                    'lname' => $lname,
                    'fname' => $fname,
                    'is_student' => 1,
                    'email' => $email,
                    'gender' => $gender,
                    'password' => Hash::make($pass1),
                    'created_at' => now()
                ]);

                $id = DB::table("users")->where("email", $email)->value("id");
                $verify_link = route("email.verify", $id);
                $message = "Thank you for to Registering Your email address";
                Mail::to($email)->send(new SendMail("Email Verification", $message, $verify_link));
                $response = "Registration Successfull, Verify Your Email.";
            } else {
                $response = "Email Already Exists!";
            }
        } else {
            $response = "Passwords Don't Match!";
        }
        return response($response);
    }

    public function verify_email($id)
    {
        //Verify Email
        $verified = DB::table("users")->where("id", $id)->value("email_verified");
        $email = DB::table("users")->where("id", $id)->value("email");
        if ($verified != 1) {
            DB::table("users")->where("id", $id)->update([
                'email_verified' => 1,
                'is_active' => 1
            ]);
            return view("login.verify_email", compact("email"));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function update_password(Request $req)
    {
        $old_pass = $req->old_password;
        $new_pass = $req->new_password;
        $confirm = $req->confirm_new_password;
        $current_password = DB::table("users")->where("id", Auth::user()->id)->value("password");
        if (Hash::check($old_pass, $current_password)) {
            if ($new_pass == $confirm) {
                try {
                    DB::table("users")->where("id", Auth::user()->id)->update([
                        'password' => Hash::make($new_pass)
                    ]);
                    $response = "Password Update successfully";
                } catch (Exception $e) {
                    $response = "Failed to Update Password!";
                }
            } else {
                $response = "Password Mismatch!";
            }
        } else {
            $response = "Old Password Incorrect!";
        }
        return response($response);
    }
}
