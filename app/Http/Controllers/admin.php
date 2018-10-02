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

class admin extends Controller
{
    public function show_login(){
        return view('admin.welcome');
    }

    public function do_login(Request $request){
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->fails()){
            return redirect('/admin')
                ->withErrors($validator)
                ->withInput()->exceptInput('password');
        } else {
            $login = array('no_pegawai' => $request->username, 'password' => $request->password);

            if (Auth::guard('admin')->attempt($login, $request->remember)){
                return redirect('/admin/admin_dashboard');
            } else {
                return redirect('/admin');
            }
        }
    }

    public function do_logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function show_dashboard(){
        return view('admin.admin_dashboard');
    }

    public function show_create_user_page(){
        $student = DB::table('tbl_students')->select('nisn','nama')->get();
        $teacher = DB::table('tbl_teachers')->select('nign','nama')->get();

        return view('admin.create_user')->with(['students'=>$student,'teachers'=>$teacher]);
    }

    public function do_create_user(Request $request){

        switch ($request->user_type){
            case 'student':
                $rules = [
                    'username' => 'required|min:3|unique:tbl_students,nisn',
                    'nama' => 'required|min:3',
                    'password'=> 'required|min:3',
                    'user_type' => 'required',
                ];

                $validator = Validator::make($request->all(),$rules);

                if ($validator->fails()){
                    return redirect('/admin/admin_dashboard/create_user')
                        ->withErrors($validator)
                        ->withInput()->exceptInput('password');
                } else {
                    $tblStudent = new tblStudent();
                    $tblStudent->nisn = $request->username;
                    $tblStudent->password = Hash::make($request->password);
                    $tblStudent->nama = $request->nama;
                    $tblStudent->isAdmin = false;
                    $tblStudent->save();

                    return redirect('/admin/admin_dashboard/create_user');
                }

                break;
            case 'teacher':
                $rules = [
                    'username' => 'required|min:3|unique:tbl_teachers,nign',
                    'nama' => 'required|min:3',
                    'password'=> 'required|min:3',
                    'user_type' => 'required',
                ];

                $validator = Validator::make($request->all(),$rules);

                if ($validator->fails()){
                    return redirect('/admin/admin_dashboard/create_user')
                        ->withErrors($validator)
                        ->withInput()->exceptInput('password');
                } else {
                    $tblTeacher = new tblTeacher();
                    $tblTeacher->nign = $request->username;
                    $tblTeacher->password = Hash::make($request->password);
                    $tblTeacher->nama = $request->nama;
                    $tblTeacher->isAdmin = false;
                    $tblTeacher->save();

                    return redirect('/admin/admin_dashboard/create_user');
                }
                break;
        }

    }
}
