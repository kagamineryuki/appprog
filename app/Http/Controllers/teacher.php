<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class teacher extends Controller
{
    public function show_dashboard(){
        return view("teacher.teacher_dashboard");
    }

    public function do_logout(){
        Auth::guard('teacher')->logout();
        return redirect('/');
    }
}
