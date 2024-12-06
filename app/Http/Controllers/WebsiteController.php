<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function home(){
        return view("website.home");
    }

    public function about(){
        return view("website.about");
    }

    public function courses(){
        return view("website.courses");
    }

    public function team(){
        return view("website.team");
    }

    public function contact(){
        return view("website.contact");
    }
}
