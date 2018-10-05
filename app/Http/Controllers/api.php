<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tblAbsensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class api extends Controller
{
    public function receive_qr(Request $request){
        $data = DB::select(
            'SELECT tbl_teachers.nama AS teacher_name,
                    tbl_pelajarans.nama_pelajaran AS nama_pelajaran,
                    tbl_students.nama AS student_name,
                    tbl_codes.created_at AS created_at,
                    tbl_codes.valid_until AS valid_until
                    FROM tbl_codes,tbl_students,tbl_teachers,tbl_pelajarans
                    WHERE
                      tbl_codes.id_qr = :id_qr AND tbl_students.nisn = :nisn AND tbl_pelajarans.kode_pelajaran = :kode_pelajaran AND tbl_teachers.nign = :nign',
            [   'id_qr'=>$request->kode_qr,
                'nisn'=>$request->nisn,
                'kode_pelajaran'=>$request->kode_pelajaran,
                'nign'=>$request->nign
            ]);

        if (empty($data)){
            $absensi = new tblAbsensi();
            $absensi->nisn = $request->nisn;
            $absensi->id_qr = $request->kode_qr;
            $absensi->save();
        }

        return $data;
    }

    public function give_info(Request $request){
        return response()->json(['nisn' => auth()->guard('student')->user()->nisn]);
    }
}
