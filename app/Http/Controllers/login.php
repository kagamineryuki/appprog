<?php

namespace App\Http\Controllers;

use App\tblTeacher;
use App\tblStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class login extends Controller
{
    public function show_login(){
        return view('welcome');
    }

    public function show_student_dashboard(){
        return view('student_dashboard');
    }

    public function process_login(Request $request){
        $rules = array(
            'username' => 'required',
            'password' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('/')
                ->withErrors($validator);
        } else {

            switch ($request->user_type){
                case "student" :
                    $userdata = array(
                        "nisn" => $request->username,
                        "password" => $request->password,
                        "isAdmin" => false
                    );

                    if (Auth::guard('student')->attempt($userdata, $request->remember)){
                        return redirect('/student_dashboard');
                    } else {
                        return redirect('/');
                    }
                    break;
                case "teacher" :
                    $userdata = array(
                        "nign" => $request->username,
                        "password" => $request->password,
                        "isAdmin" => false
                    );

                    if (Auth::guard('teacher')->attempt($userdata, $request->remember)){
                        return redirect('/teacher/teacher_dashboard');
                    } else {
                        return redirect('/');
                    }
                    break;
            }
        }
    }

    public function process_logout(){
        if (auth()->guard('student')->check()){
            auth()->guard('student')->logout();
            return redirect('/');
        } elseif (auth()->guard('teacher')->check()){
            auth()->guard('teacher')->logout();
                return redirect('/');
        }
    }
}
