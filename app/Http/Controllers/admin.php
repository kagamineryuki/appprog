<?php

namespace App\Http\Controllers;

use App\tblTeacher;
use App\tblStudent;
use App\tblPelajaran;
use App\tblKelas;
use Faker\Provider\Image;
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

    public function show_dashboard(){
        $student = DB::table('tbl_students')->select('nisn','nama')->get();
        $teacher = DB::table('tbl_teachers')->select('nign','nama')->get();
        $pelajaran = DB::table('tbl_pelajarans')->select('kode_pelajaran','nama_pelajaran')->get();
        $kelas = DB::table('tbl_kelas')->select('kode_kelas','nama_kelas')->get();

        return view('admin.admin_dashboard')->with(['students'=>$student,'teachers'=>$teacher,'pelajaran'=>$pelajaran,'kelas'=>$kelas]);
    }

    public function show_create_user_page(){
        $student = DB::table('tbl_students')->select('nisn','nama')->get();
        $teacher = DB::table('tbl_teachers')->select('nign','nama')->get();
        $pelajaran = DB::table('tbl_pelajarans')->select('kode_pelajaran','nama_pelajaran')->get();
        $kelas = DB::table('tbl_kelas')->select('kode_kelas','nama_kelas')->get();

        return view('admin.create_user')->with(['students'=>$student,'teachers'=>$teacher,'pelajaran'=>$pelajaran,'kelas'=>$kelas]);
    }

    public function show_change_user_page(){
        return view('admin.change_data');
    }

    public function show_delete_user_page(){
        return view('admin.delete_data');
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

    public function do_create_user(Request $request){

        switch ($request->user_type){
            case 'student':
                $rules = [
                    'username' => 'required|min:3|unique:tbl_students,nisn',
                    'nama' => 'required|min:3',
                    'password'=> 'required|min:3',
                    'user_type' => 'required',
                    'foto_profil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ];

                $validator = Validator::make($request->all(),$rules);

                if ($validator->fails()){
                    return redirect('/admin/admin_dashboard/create_user')
                        ->withErrors($validator)
                        ->withInput()->exceptInput('password');
                } else {

                    $tblStudent = new tblStudent();

                    if($request->hasFile('foto_profil')){
                        $file_fullname = $request->file('foto_profil')->getClientOriginalName();
                        $filename = pathinfo($file_fullname, PATHINFO_FILENAME);
                        $file_extension = $request->file('foto_profil')->getClientOriginalExtension();
                        $filename_to_save = time().'_'.$filename.'.'.$file_extension;
                        $path = $request->file('foto_profil')->storeAs('public/uploads', $filename_to_save);
                        $tblStudent->profile_picture = $filename_to_save;
                    }

                    $tblStudent->nisn = $request->username;
                    $tblStudent->password = Hash::make($request->password);
                    $tblStudent->nama = $request->nama;
                    $tblStudent->alamat = $request->alamat;
                    $tblStudent->tanggal_lahir = $request->tgllahir;
                    $tblStudent->tempat_lahir = $request->tempat_lahir;
                    $tblStudent->no_telp = $request->notelp;
                    $tblStudent->isAdmin = false;
                    $tblStudent->profile_picture = "question_mark.png";
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
                    'foto_profil' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ];

                $validator = Validator::make($request->all(),$rules);

                if ($validator->fails()){
                    return redirect('/admin/admin_dashboard/create_user')
                        ->withErrors($validator)
                        ->withInput()->exceptInput('password');
                } else {
                    $tblTeacher = new tblTeacher();

                    if($request->hasFile('foto_profil')){
                        $file_fullname = $request->file('foto_profil')->getClientOriginalName();
                        $filename = pathinfo($file_fullname, PATHINFO_FILENAME);
                        $file_extension = $request->file('foto_profil')->getClientOriginalExtension();
                        $filename_to_save = time().'_'.$filename.'.'.$file_extension;
                        $path = $request->file('foto_profil')->storeAs('public/uploads', $filename_to_save);

                        $tblTeacher->profile_picture = $filename_to_save;
                    }

                    $tblTeacher->nign = $request->username;
                    $tblTeacher->password = Hash::make($request->password);
                    $tblTeacher->nama = $request->nama;
                    $tblTeacher->alamat = $request->alamat;
                    $tblTeacher->tanggal_lahir = $request->tgllahir;
                    $tblTeacher->tempat_lahir = $request->tempat_lahir;
                    $tblTeacher->no_telp = $request->notelp;
                    $tblTeacher->profile_picture = "question_mark.png";
                    $tblTeacher->isAdmin = false;
                    $tblTeacher->save();

                    return redirect('/admin/admin_dashboard/create_user');
                }
                break;
        }

    }

    public function do_create_pelajaran(Request $request){
        $rules = [
            'kode_pelajaran' => 'required|unique:tbl_pelajarans',
            'nama_pelajaran' => 'required|min:3'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect('/admin/admin_dashboard/create_user')
                ->withErrors($validator)
                ->withInput();
        }else {
            $pelajaran = new tblPelajaran();
            $pelajaran->kode_pelajaran = $request->kode_pelajaran;
            $pelajaran->nama_pelajaran = $request->nama_pelajaran;
            $pelajaran->save();

            return redirect('/admin/admin_dashboard/create_user');
        }
    }

    public function do_create_kelas(Request $request){
        $rules = [
            'kode_kelas' => 'required|unique:tbl_kelas',
            'nama_kelas' => 'required|min:3'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect('/admin/admin_dashboard/create_user')
                ->withErrors($validator)
                ->withInput();
        }else {
            $kelas = new tblKelas();
            $kelas->kode_kelas = $request->kode_kelas;
            $kelas->nama_kelas = $request->nama_kelas;
            $kelas->save();
        }
        return redirect('/admin/admin_dashboard/create_user');
    }
}
