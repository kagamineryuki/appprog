@extends('template')
@extends('student_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')
    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <div class="container">
            <h1 class="display-4">About Me</h1>
            <hr>
            <form method="POST" action="/api/update_user_info_web" enctype="multipart/form-data">
                <div class="d-flex">
                    <div class="container col-8">
                        {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group mb-3 col-2">
                                <label class="mr-3"><strong>NIGN</strong></label>
                                <input type="text" class="form-control " name="nisn"
                                       value="{{$nisn}}" readonly>
                                <div class="invalid-feedback">
                                    @if($errors->has('username'))
                                        <p class="text-danger">{{$errors->first('username')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-3 col-10">
                                <label class="mr-3"><strong>Name*</strong></label>
                                <input type="text" class="form-control " value="{{$nama}}" name="nama">
                                <div class="invalid-feedback">
                                    @if($errors->has('nama'))
                                        <p class="text-danger">{{$errors->first('nama')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="mr-3"><strong>Address</strong></label>
                            <input type="text" class="form-control " value="{{$alamat}}" name="alamat">
                            <div class="invalid-feedback">
                                @if($errors->has('alamat'))
                                    <p class="text-danger">{{$errors->first('alamat')}}</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group mb-3 col-2">
                                <label class="mr-3"><strong>Birthplace</strong></label>
                                <input type="text" class="form-control" value="{{$tempat_lahir}}" name="tempat_lahir">
                                <div class="invalid-feedback">
                                    @if($errors->has('tempat_lahir'))
                                        <p class="text-danger">{{$errors->first('tempat_lahir')}}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group mb-3 col-10">
                                <label class="mr-3"><strong>Birthdate</strong></label>
                                <input type="date" class="form-control" value="{{$tanggal_lahir}}" name="tanggal_lahir">
                                <div class="invalid-feedback">
                                    @if($errors->has('tgllahir'))
                                        <p class="text-danger">{{$errors->first('tgllahir')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="mr-3"><strong>Phone Number</strong></label>
                            <input type="number" class="form-control" value="{{$no_telp}}" name="no_telp">
                            <div class="invalid-feedback">
                                @if($errors->has('notelp'))
                                    <p class="text-danger">{{$errors->first('notelp')}}</p>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="user_type" value="student">

                        <input type="submit" class="btn btn-primary" value="Update Profile">

                    </div>
                    <div class="container col-4">
                        <div class="form-group mb-3">
                            <label class="mr-3"><strong>Profile Picture</strong></label>
                            <br>
                            <img src="{{asset('storage/uploads/'.$profile_picture)}}" class="rounded-circle mb-2 border" style="width:100px">
                            <input type="file" class="form-control-file" name="foto_profil">
                            <div class="invalid-feedback">
                                @if($errors->has('foto_profil'))
                                    <p class="text-danger">{{$errors->first('foto_profil')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@endsection