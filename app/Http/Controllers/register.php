<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class register extends Controller
{
    public function show_register(){
        return view('admin.create_user');
    }

    public function do_register(Request $request){
        $rules = [
            'username' => 'required|min:3',
            'nama' => 'required|min:3',
            'password'=> 'required|min:3',
            'user_type' => 'required',
            'isAdmin' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()){
            return redirect('/admin/create_user')
                ->withErrors($validator)
                ->withInput()->exceptInput('password');
        } else {
            switch ($request->keys('user_type')){
                case 'student':
                    $student = new App\tblStudent;
                    $student->nisn = $request['nisn'];
                    $student->nama = $request['nama'];
                    $student->password = Hash::make($request['password']);
                    $student->isAdmin = 0;
                    $student->save();
                    redirect('/admin/create_user');
                    break;
                case 'teacher':
                    $teacher = new App\tblTeacher;
                    $teacher->nign = $request['nisn'];
                    $teacher->nama = $request['nama'];
                    $teacher->password = Hash::make($request['password']);
                    $teacher->isAdmin = 0;
                    $teacher->save();
                    break;
            }
        }

    }
}
