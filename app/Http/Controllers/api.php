<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tblAbsensi;
use App\tblStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class api extends Controller
{
    public function verify_user(Request $request){
        $query = DB::table('tbl_students')->select('nisn','password','nama')->where('nisn',$request->username)->first();

        if(Hash::check($request->password,$query->password)){
            $result = [
                'nisn'=>$query->nisn,
                'name'=>$query->nama,
                'message'=>"You're logged in. Have a nice day, ".$query->nama,
                'error' => FALSE
            ];

            return $result;
        }else{
            $result = [
                'message'=>"Please check your credential",
                'error' => FALSE
            ];

            return $result;
        }
    }

    public function receive_qr(Request $request){
        $splitted_qr_code = explode(",",$request->kode_qr);
        $data = DB::select(
            'SELECT 
                    tbl_teachers.nama AS teacher_name,
                    tbl_pelajarans.nama_pelajaran AS nama_pelajaran,
                    tbl_students.nama AS student_name,
                    tbl_codes.created_at AS created_at,
                    tbl_codes.valid_until AS valid_until,
                    tbl_kelas.nama_kelas AS nama_kelas
                    
                    FROM 
                    tbl_codes,tbl_students,tbl_teachers,tbl_pelajarans,tbl_kelas
                    
                    WHERE
                      tbl_codes.id_qr = :id_qr AND tbl_students.nisn = :nisn AND tbl_pelajarans.kode_pelajaran = :kode_pelajaran AND tbl_teachers.nign = :nign AND tbl_kelas.kode_kelas = :kode_kelas',
            [   'id_qr'=>$splitted_qr_code[0],
                'kode_kelas'=>$splitted_qr_code[1],
                'nisn'=>$request->nisn,
                'kode_pelajaran'=>$splitted_qr_code[2],
                'nign'=>$splitted_qr_code[3]
            ]);

        $absensi = new tblAbsensi();
        $absensi->nisn = $request->nisn;
        $absensi->id_qr = $splitted_qr_code[0];
        $absensi->save();

        if (empty($data)){
        }

        return $data;
    }

    public function give_info(Request $request){
        return response()->json(['nisn' => auth()->guard('student')->user()->nisn]);
    }
}
