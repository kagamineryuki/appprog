<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class teacher extends Controller
{
    public function dashboard(){
        return view("teacher.dashboard");
    }
}
