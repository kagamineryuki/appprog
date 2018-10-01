<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class login extends Controller
{
    public function show_login(){
        return view('welcome');
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

            $userdata = array(
                "nisn" => Input::get('username'),
                "password" => Input::get('password'),
                "isAdmin" => false
            );

            switch (Input::get('user_type')){
                case "student" :
                    if (Auth::attempt($userdata)){
                        return view(teacher.dashboard);
                    } else {
                        return Redirect::to('welcome');
                    }
                    break;
                case "teacher" :
                    break;
            }
        }
    }
}
