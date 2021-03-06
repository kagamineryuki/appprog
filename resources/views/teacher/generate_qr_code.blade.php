@extends('template')
@extends('teacher.dashboard_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')
    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">Generate QR Code</h1>
        <hr>
        <div class="container">
            <form method="POST" action="/teacher/teacher_dashboard/generate_qr_code/proceed">
                {{csrf_field()}}
                <div class="form-row">
                    <div class="col">
                        <label>Class</label>
                        <select class="form-control is-invalid" name="kelas">
                            @foreach($kelas as $per_kelas)
                                <option value="{{$per_kelas->kode_kelas}}">{{$per_kelas->kode_kelas}}
                                    | {{$per_kelas->nama_kelas}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @if($errors->has('kelas'))
                                <p class="text-danger">{{$errors->first('kelas')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <label>Lesson</label>
                        <select class="form-control is-invalid" name="pelajaran">
                            @foreach($pelajaran as $per_pelajaran)
                                <option value="{{$per_pelajaran->kode_pelajaran}}">{{$per_pelajaran->kode_pelajaran}}
                                    | {{$per_pelajaran->nama_pelajaran}}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @if($errors->has('pelajaran'))
                                <p class="text-danger">{{$errors->first('pelajaran')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="col">
                        <label>Valid until</label>
                        <input type="datetime-local" class="form-control is-invalid" name="valid_until"
                               value="{{old('valid_until')}}">
                        <div class="invalid-feedback">
                            @if($errors->has('valid_until'))
                                <p class="text-danger">{{$errors->first('valid_until')}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary mt-3" value="Create QR">
            </form>
            <hr>
            <h1 class="display-4 m-0">QR Code</h1>

            <div class="container d-flex m-0 align-content-center justify-content-center">
                @if(!empty($qr_code))
                    {{QRCode::text($qr_code->id_qr.",".$qr_code->kode_kelas.",".$qr_code->kode_pelajaran.",".$qr_code->nign)->setSize(35)->setErrorCorrectionLevel('H')->svg()}}
                @endif
                <div class="align-self-center">
                    @if(!empty($qr_code))
                        <h1 class="h1 text-center m-0"><strong>Can't scan the code ?</strong></h1>
                        <h1 class="h2 text-center">
                            <strong>{{$qr_code->id_qr.",".$qr_code->kode_kelas.",".$qr_code->kode_pelajaran.",".$qr_code->nign}}</strong>
                        </h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@endsection