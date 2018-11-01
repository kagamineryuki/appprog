<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use LaravelQRCode\Facades\QRCode;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\tblKelas;
use App\tblAbsensi;
use App\unify;
use App\tblCode;

class teacher extends Controller
{
    public function show_dashboard()
    {
        $user_info = DB::table('tbl_teachers')->select('nign', 'nama', 'alamat', 'tanggal_lahir', 'tempat_lahir', 'no_telp', 'profile_picture')->where(['nign' => auth()->guard('teacher')->user()->nign, 'soft_delete' => '0'])->first();

        return view("teacher.teacher_dashboard")
            ->with([
                'profile_picture' => $user_info->profile_picture,
                'nign' => $user_info->nign,
                'nama' => $user_info->nama,
                'alamat' => $user_info->alamat,
                'tanggal_lahir' => $user_info->tanggal_lahir,
                'tempat_lahir' => $user_info->tempat_lahir,
                'no_telp' => $user_info->no_telp,
            ]);
    }

    public function show_generate_qr_code()
    {
        $kelas = DB::table('tbl_kelas')->select('kode_kelas', 'nama_kelas')->get();
        $pelajaran = DB::table('tbl_pelajarans')->select('kode_pelajaran', 'nama_pelajaran')->get();
        $qr_code = DB::table('tbl_codes')->select()->latest()->first();

        return view("teacher.generate_qr_code")->with(['kelas' => $kelas, 'pelajaran' => $pelajaran, 'qr_code' => $qr_code]);

//        return dd($qr_code);
//        return dd(Auth::guard('teacher')->user()->nign);
    }

    public function generate_qr(Request $request)
    {
        $rules = [
            'kelas' => 'required',
            'pelajaran' => 'required',
            'valid_until' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect('/teacher/teacher_dashboard/generate_qr_code')
                ->withErrors($validator)
                ->withInput();
        } else {
            $qr = new tblCode();
            $qr->valid_until = $request->valid_until;
            $qr->kode_pelajaran = $request->pelajaran;
            $qr->kode_kelas = $request->kelas;
            $qr->nign = Auth::guard('teacher')->user()->nign;
            $qr->save();

            return redirect('/teacher/teacher_dashboard/generate_qr_code');
        }
    }

    public function show_history(Request $request)
    {
        $query = (new unify())->newQuery();
        $query->where('pengampu',Auth::guard('teacher')->user()->nama);

        if ($request->nisn != '') {
            $query->where('nisn', $request->nisn);
        }

        if ($request->tardiness != '') {
            $query->where('status_hadir', $request->tardiness);
        }

        $query = $query->paginate(10)->appends(['nisn'=>request('nisn'),'tardiness'=>request('tardiness')]);

//            return dd($query)
        return view("teacher.history")->with(["query" => $query]);

    }

    public function do_logout()
    {
        Auth::guard('teacher')->logout();
        return redirect('/');
    }
}
