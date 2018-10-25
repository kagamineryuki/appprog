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
        $data = DB::select(
            'SELECT DISTINCT 
                    tbl_teachers.nama AS teacher_name,
                    tbl_pelajarans.nama_pelajaran AS nama_pelajaran,
                    tbl_students.nama AS student_name,
                    tbl_absensis.created_at AS created_at,
                    tbl_codes.valid_until AS valid_until,
                    tbl_kelas.nama_kelas AS nama_kelas
                    
                    FROM 
                    tbl_codes,tbl_students,tbl_teachers,tbl_pelajarans,tbl_kelas,tbl_absensis
                    
                    WHERE
                    tbl_absensis.nisn = :nisn',
            ['nisn'=>auth()->guard('student')->user()->nisn]);
        return view('student_dashboard')->with(['data'=>$data]);
    }

    public function show_student_profile(){

        $user_info = DB::table('tbl_students')->select('nisn','nama','alamat','tanggal_lahir','tempat_lahir','no_telp','profile_picture')->where(['nisn'=> auth()->guard('student')->user()->nisn,'soft_delete'=>'0'])->first();

        return view('student_profile')
            ->with([
                'profile_picture'=>$user_info->profile_picture,
                'nisn'=>$user_info->nisn,
                'nama'=>$user_info->nama,
                'alamat'=>$user_info->alamat,
                'tanggal_lahir'=>$user_info->tanggal_lahir,
                'tempat_lahir'=>$user_info->tempat_lahir,
                'no_telp'=>$user_info->no_telp,
            ]);
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
                        return redirect('/student/student_dashboard');
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
                        return redirect('/teacher/teacher_dashboard/history');
                    } else {
                        return redirect('/');
                    }
                    break;
            }
        }
    }

    public function process_logout(){
        auth()->guard('student')->logout();
        return redirect('/');
    }
}
