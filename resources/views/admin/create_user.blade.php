@extends('template')
@extends('admin.dashboard_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')

    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">Create User</h1>
        <form method="POST" action="{{route('register')}}">
            {{csrf_field()}}
            <div class="form-group mb-3">
                <label class="mr-3"><strong>NISN / NIGN</strong></label>
                <input type="text" class="form-control col-5 is-invalid" name="username" value="{{old('username')}}">
                <div class="invalid-feedback">
                    @if($errors->has('username'))
                        <p class="text-danger">{{$errors->first('username')}}</p>
                    @endif
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="mr-3"><strong>Nama</strong></label>
                <input type="text" class="form-control col-5 is-invalid" value="{{old('nama')}}" name="nama">
                <div class="invalid-feedback">
                    @if($errors->has('nama'))
                        <p class="text-danger">{{$errors->first('nama')}}</p>
                    @endif
                </div>
            </div>
            <div class="form-group mb-3">
                <label class="mr-3"><strong>Password</strong></label>
                <input type="password" class="form-control col-5 is-invalid" name="password">
                <div class="invalid-feedback">
                    @if($errors->has('password'))
                        <p class="text-danger">{{$errors->first('password')}}</p>
                    @endif
                </div>
            </div>

            <div class="form-inline mb-3">
                <input type="radio" name="user_type" value="student" class="form-control mr-3" checked>
                <label class="mr-5"><strong>Student</strong></label>
                <input type="radio" name="user_type" value="teacher" class="form-control mr-3">
                <label><strong>Teacher</strong></label>
            </div>

            <input type="submit" class="btn btn-primary">
        </form>
        <hr>
        <div class="d-flex justify-content-around">
            <div>
                <h1 class="display-4">Students</h1>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama</th>
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
                <h1 class="display-4">Teacher</h1>
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">NIGN</th>
                        <th scope="col">Nama</th>
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

@endsection
@endsection
