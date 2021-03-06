@extends('template')
@extends('admin.dashboard_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')

    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">Create Data</h1>
        <hr>
        {{--Create users for student and teacher--}}
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">User</h1>
                <form method="POST" action="/admin/admin_dashboard/create_user/proceed/create_user" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>NISN / NIGN*</strong></label>
                        <input type="text" class="form-control " name="username"
                               value="{{old('username')}}">
                        <div class="invalid-feedback">
                            @if($errors->has('username'))
                                <p class="text-danger">{{$errors->first('username')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Password*</strong></label>
                        <input type="password" class="form-control " name="password">
                        <div class="invalid-feedback">
                            @if($errors->has('password'))
                                <p class="text-danger">{{$errors->first('password')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Name*</strong></label>
                        <input type="text" class="form-control " value="{{old('nama')}}" name="nama">
                        <div class="invalid-feedback">
                            @if($errors->has('nama'))
                                <p class="text-danger">{{$errors->first('nama')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Address</strong></label>
                        <input type="text" class="form-control " value="{{old('alamat')}}" name="alamat">
                        <div class="invalid-feedback">
                            @if($errors->has('alamat'))
                                <p class="text-danger">{{$errors->first('alamat')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Birthplace</strong></label>
                        <input type="text" class="form-control" value="{{old('tempat_lahir')}}" name="tempat_lahir">
                        <div class="invalid-feedback">
                            @if($errors->has('tempat_lahir'))
                                <p class="text-danger">{{$errors->first('tempat_lahir')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Birthdate</strong></label>
                        <input type="date" class="form-control" value="{{old('tgllahir')}}" name="tgllahir">
                        <div class="invalid-feedback">
                            @if($errors->has('tgllahir'))
                                <p class="text-danger">{{$errors->first('tgllahir')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Phone Number</strong></label>
                        <input type="number" class="form-control" value="{{old('notelp')}}" name="notelp">
                        <div class="invalid-feedback">
                            @if($errors->has('notelp'))
                                <p class="text-danger">{{$errors->first('notelp')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Profile Picture</strong></label>
                        <input type="file" class="form-control-file" name="foto_profil">
                        <div class="invalid-feedback">
                            @if($errors->has('foto_profil'))
                                <p class="text-danger">{{$errors->first('foto_profil')}}</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-inline mb-3">
                        <input type="radio" name="user_type" value="student" class="form-control mr-3" checked>
                        <label class="mr-5"><strong>Student</strong></label>
                        <input type="radio" name="user_type" value="teacher" class="form-control mr-3">
                        <label><strong>Teacher</strong></label>
                    </div>

                    <p class="text-danger"><strong>*Inputs are required !</strong></p>

                    <input type="submit" class="btn btn-primary" value="Add User">
                </form>
            </div>

            {{--All student and teacher data--}}
            <div class="d-flex container">
                <div class="mr-5">
                    <h1 class="display-4">Students</h1>
                    <table class="table table-striped table-bordered">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">NISN</th>
                            <th scope="col">Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $student)
                            <tr>
                                <td>{{$student->nisn}}</td>
                                <td>{{$student->nama}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div>
                    <div>
                        <h1 class="display-4">Teacher</h1>
                        <table class="table table-striped table-bordered">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">NIGN</th>
                                <th scope="col">Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teachers as $teacher)
                                <tr>
                                    <td>{{$teacher->nign}}</td>
                                    <td>{{$teacher->nama}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        {{--Create items for lesson--}}
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">Lesson</h1>
                <form method="POST" action="/admin/admin_dashboard/create_user/proceed/create_pelajaran">
                    {{csrf_field()}}
                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Lesson Code*</strong></label>
                        <input type="text" class="form-control " value="{{old('kode_pelajaran')}}"
                               name="kode_pelajaran">
                        <div class="invalid-feedback">
                            @if($errors->has('kode_pelajaran'))
                                <p class="text-danger">{{$errors->first('kode_pelajaran')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Lesson Name*</strong></label>
                        <input type="text" class="form-control " value="{{old('nama_pelajaran')}}"
                               name="nama_pelajaran">
                        <div class="invalid-feedback">
                            @if($errors->has('nama_pelajaran'))
                                <p class="text-danger">{{$errors->first('nama_pelajaran')}}</p>
                            @endif
                        </div>
                    </div>

                    <p class="text-danger"><strong>*Inputs are required !</strong></p>

                    <input type="submit" class="btn btn-primary" value="Add Lesson">
                </form>
            </div>
            {{--List of lessons--}}
            <div class="container">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Lesson Code</th>
                        <th scope="col">Lesson Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pelajaran as $pelajaran)
                        <tr>
                            <td>{{$pelajaran->kode_pelajaran}}</td>
                            <td>{{$pelajaran->nama_pelajaran}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        <hr>
        {{--Create items for class--}}
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">Class</h1>
                <form method="POST" action="/admin/admin_dashboard/create_user/proceed/create_kelas">
                    {{csrf_field()}}
                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Class Code*</strong></label>
                        <input type="text" class="form-control " value="{{old('kode_kelas')}}"
                               name="kode_kelas">
                        <div class="invalid-feedback">
                            @if($errors->has('kode_kelas'))
                                <p class="text-danger">{{$errors->first('kode_kelas')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="mr-3"><strong>Class Name*</strong></label>
                        <input type="text" class="form-control  " value="{{old('nama_kelas')}}" name="nama_kelas">
                        <div class="invalid-feedback">
                            @if($errors->has('nama_kelas'))
                                <p class="text-danger">{{$errors->first('nama_kelas')}}</p>
                            @endif
                        </div>
                    </div>

                    <p class="text-danger"><strong>*Inputs are required !</strong></p>

                    <input type="submit" class="btn btn-primary" value="Add Class">
                </form>
            </div>
            {{--List of classes--}}
            <div class="container">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Class Code</th>
                        <th scope="col">Class Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($kelas as $kelas)
                        <tr>
                            <td>{{$kelas->kode_kelas}}</td>
                            <td>{{$kelas->nama_kelas}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@endsection