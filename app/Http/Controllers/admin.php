<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tblStudent;
use App\tblTeacher;

class admin extends Controller
{
    public function show_register(){
        return view('admin.create_user');
    }

    public function do_register(Request $request){
        $rules = [
            'username' => 'required|unique|min:3',
            'nama' => 'required|min:3',
            'password'=> 'required|min:3',
            'user_type' => 'required',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()){
            return redirect('/admin/create_user')
                ->withErrors($validator)
                ->withInput()->exceptInput('password');
        } else {
            switch ($request->keys('user_type')){
                case 'student':
                    $student = new tblStudent();
                    $student->nisn = $request->keys('nisn');
                    $student->nama = $request->keys('nama');
                    $student->isAdmin = false;
                    redirect('/admin/create_user');
                    break;
                case 'teacher':
                    $teacher = new tblTeacher();
                    $teacher->nign = $request->keys('nisn');
                    $teacher->nama = $request->keys('nama');
                    $teacher->password = $request->keys('password');
                    $teacher->isAdmin = false;
                    redirect('/admin/create_user');
                    break;
            }
        }

    }
}
