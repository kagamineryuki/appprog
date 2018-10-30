<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tblAbsensi;
use App\tblStudent;
use App\tblPelajaran;
use App\tblKelas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class api extends Controller
{
//  all user function
    public function verify_user(Request $request)
    {
        $query = DB::table('tbl_students')->select('nisn', 'password', 'nama')->where(['nisn' => $request->username, 'soft_delete' => '0'])->first();

        if (Hash::check($request->password, $query->password)) {
            $result = [
                'nisn' => $query->nisn,
                'name' => $query->nama,
                'message' => "You're logged in. Have a nice day, " . $query->nama,
                'error' => FALSE
            ];

            return $result;
        } else {
            $result = [
                'message' => "Please check your credential",
                'error' => FALSE
            ];

            return $result;
        }
    }

    public function give_info(Request $request)
    {
        return response()->json(['nisn' => auth()->guard('student')->user()->nisn]);
    }

    public function retrieve_user_info(Request $request)
    {
        switch ($request->user_type) {
            case "student":
                $user_info = DB::table('tbl_students')->select('nisn', 'nama', 'alamat', 'tanggal_lahir', 'tempat_lahir', 'no_telp', 'profile_picture')->where(['nisn' => $request->nisn, 'soft_delete' => '0'])->first();

                return response()->json($user_info);
                break;
            case "teacher":
                $user_info = DB::table('tbl_teachers')->select('nign', 'nama', 'alamat', 'tanggal_lahir', 'tempat_lahir', 'no_telp', 'profile_picture')->where(['nign' => $request->nign, 'soft_delete' => '0'])->first();

                return response()->json($user_info);
                break;
        }
    }

    public function update_user_info(Request $request)
    {

        $rules = [
            'nama' => 'required|Min:2',
            'user_type' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()]);
        } else {
            switch ($request->user_type) {
                case "student":
                    $rules = [
                        'nisn' => 'required'
                    ];

                    $local_validator = Validator::make($request->all(), $rules);

                    if ($local_validator->fails()) {
                        return response()->json(['error' => true, 'message' => $local_validator->errors()]);
                    } else {
                        if ($request->hasFile('foto_profil')) {
                            $file_fullname = $request->file('foto_profil')->getClientOriginalName();
                            $filename = pathinfo($file_fullname, PATHINFO_FILENAME);
                            $file_extension = $request->file('foto_profil')->getClientOriginalExtension();
                            $filename_to_save = time() . '_' . $filename . '.' . $file_extension;
                            $path = $request->file('foto_profil')->storeAs('public/uploads', $filename_to_save);

                            DB::table('tbl_students')->where('nisn', '=', $request->nisn)->update([
                                'nama' => $request->nama,
                                'alamat' => $request->alamat,
                                'no_telp' => $request->no_telp,
                                'tempat_lahir' => $request->tempat_lahir,
                                'tanggal_lahir' => $request->tanggal_lahir,
                                'profile_picture' => $filename_to_save
                            ]);
                            return ['error' => false, 'message' => "Thank you, your biodata has been updated", 'user_type' => $request->user_type];

                        } else {
                            DB::table('tbl_students')->where('nisn', '=', $request->nisn)->update([
                                'nama' => $request->nama,
                                'alamat' => $request->alamat,
                                'no_telp' => $request->no_telp,
                                'tempat_lahir' => $request->tempat_lahir,
                                'tanggal_lahir' => $request->tanggal_lahir
                            ]);
                            return ['error' => false, 'message' => "Thank you, your biodata has been updated", 'user_type' => $request->user_type];
                        }
                        return ['error' => true, 'message' => "Failed to update your profile", 'user_type' => $request->user_type];

                    }
                    break;

                case "teacher":
                    $rules = [
                        'nign' => 'required'
                    ];

                    $local_validator = Validator::make($request->all(), $rules);

                    if ($local_validator->fails()) {
                        return response()->json(['error' => true, 'message' => $local_validator->errors()]);
                    } else {

                        if ($request->hasFile('foto_profil')) {
                            $file_fullname = $request->file('foto_profil')->getClientOriginalName();
                            $filename = pathinfo($file_fullname, PATHINFO_FILENAME);
                            $file_extension = $request->file('foto_profil')->getClientOriginalExtension();
                            $filename_to_save = time() . '_' . $filename . '.' . $file_extension;
                            $path = $request->file('foto_profil')->storeAs('public/uploads', $filename_to_save);

                            DB::table('tbl_teachers')->where('nign', '=', $request->nign)->update([
                                'nama' => $request->nama,
                                'alamat' => $request->alamat,
                                'no_telp' => $request->no_telp,
                                'tempat_lahir' => $request->tempat_lahir,
                                'tanggal_lahir' => $request->tanggal_lahir,
                                'profile_picture' => $filename_to_save
                            ]);
                            return ['error' => false, 'message' => "Thank you, your biodata has been updated"];
                        } else {
                            DB::table('tbl_teachers')->where('nign', '=', $request->nign)->update([
                                'nama' => $request->nama,
                                'alamat' => $request->alamat,
                                'no_telp' => $request->no_telp,
                                'tempat_lahir' => $request->tempat_lahir,
                                'tanggal_lahir' => $request->tanggal_lahir,
                            ]);
                            return ['error' => false, 'message' => "Thank you, your biodata has been updated"];
                        }

                    }
                    break;
            }
        }
        return redirect(view('admin.change_data'))->with(['error' => true, 'message' => "Something wrong happen"]);
    }

    public function delete_user_info(Request $request)
    {

        $rules = [
            'nama' => 'required|Min:2',
            'nisn' => 'required',
            'user_type' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()]);
        } else {
            switch ($request->user_type) {
                case "student":
                    DB::table('tbl_students')->where(['nisn' => $request->nisn, 'soft_delete' => '0'])->update([
                        'nama' => $request->nama,
                        'soft_delete' => 1
                    ]);

                    return ['error' => false, 'message' => "Data has been deleted", 'user_type' => $request->user_type];
//                return dd($request);
                    break;

                case "teacher":
                    DB::table('tbl_teachers')->where(['nign' => $request->nisn, 'soft_delete' => '0'])->update([
                        'nama' => $request->nama,
                        'soft_delete' => 1
                    ]);
                    return ['error' => false, 'message' => "Data has been deleted"];
                    break;
            }
        }
        return redirect(view('admin.change_data'))->with(['error' => true, 'message' => "Something wrong happen"]);
    }

//  all attendance related
    public function create_attendance(Request $request)
    {
        $absensi = new tblAbsensi();
        $absensi->nisn = $request->nisn;
        $absensi->id_qr = $request->id_qr;
        $absensi->save();

        return ["message" => "Data recorded, have a nice day", "error" => false];
    }

    public function get_last_10_attendance(Request $request)
    {
        $query = DB::select("CALL stDetails(:nisn)", ['nisn' => $request->nisn]);

        return response()->json($query);
    }

    public function receive_qr(Request $request)
    {
        $splitted_qr_code = explode(",", $request->kode_qr);
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
            ['id_qr' => $splitted_qr_code[0],
                'kode_kelas' => $splitted_qr_code[1],
                'nisn' => $request->nisn,
                'kode_pelajaran' => $splitted_qr_code[2],
                'nign' => $splitted_qr_code[3]
            ]);

        $absensi = new tblAbsensi();
        $absensi->nisn = $request->nisn;
        $absensi->id_qr = $splitted_qr_code[0];
        $absensi->save();

        if (empty($data)) {
        }

        return $data;
    }

//  all lesson related
    public function retrieve_pelajaran_info(Request $request)
    {
        $rules = [
            'no_pelajaran' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()]);
        } else {
            $data = DB::table('tbl_pelajarans')->select('nama_pelajaran')->where(['kode_pelajaran' => $request->no_pelajaran, 'soft_delete' => '0'])->get();

            if (!$data->count()) {
                return response()->json(['error' => true, 'message' => ["Data not found"]]);
            } else {
                return response()->json($data);
            }
        }
    }

    public function update_pelajaran_info(Request $request)
    {
        $rules = [
            'kode_pelajaran' => 'required',
            'nama_pelajaran' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()]);
        } else {
            DB::table('tbl_pelajarans')
                ->where('kode_pelajaran', $request->kode_pelajaran)
                ->update(['nama_pelajaran' => $request->nama_pelajaran]);

            return response()->json(['error' => false, 'message' => "Data has been updated!"]);
        }
    }

    public function delete_pelajaran_info(Request $request)
    {
        $rules = [
            'kode_pelajaran' => 'required',
            'nama_pelajaran' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()]);
        } else {
            DB::table('tbl_pelajarans')
                ->where('kode_pelajaran', $request->kode_pelajaran)
                ->update(['soft_delete' => '1']);

            return response()->json(['error' => false, 'message' => "Data has been deleted!"]);
        }
    }

//  all class related
    public function retrieve_kelas_info(Request $request)
    {
        $rules = [
            'kode_kelas' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()]);
        } else {
            $data = DB::table('tbl_kelas')->select('nama_kelas')->where(['kode_kelas' => $request->kode_kelas, 'soft_delete' => '0'])->get();

            if (!$data->count()) {
                return response()->json(['error' => true, 'message' => ["Data not found"]]);
            } else {
                return response()->json($data);
            }
        }
    }

    public function update_kelas_info(Request $request)
    {
        $rules = [
            'kode_kelas' => 'required',
            'nama_kelas' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()]);
        } else {
            DB::table('tbl_kelas')
                ->where('kode_kelas', $request->kode_kelas)
                ->update(['nama_kelas' => $request->nama_kelas]);

            return response()->json(['error' => false, 'message' => "Data has been updated!"]);
        }
    }

    public function delete_kelas_info(Request $request)
    {
        $rules = [
            'kode_kelas' => 'required',
            'nama_kelas' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'message' => $validator->errors()]);
        } else {
            DB::table('tbl_kelas')
                ->where('kode_kelas', $request->kode_kelas)
                ->update(['soft_delete' => '1']);

            return response()->json(['error' => false, 'message' => "Data has been deleted!"]);
        }
    }
}
