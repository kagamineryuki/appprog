@extends('template')
@extends('admin.dashboard_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">I'm Here!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        <div class="bg-light align-items-stretch" id="sidebar">
            <ul class="list-group">
                <a href="#"><li class="list-group-item">Dashboard</li></a>
                <a href="#"><li class="list-group-item active">Create User</li></a>
                <a href="#"><li class="list-group-item ">Update User</li></a>
                <a href="#"><li class="list-group-item ">Remove User</li></a>

            </ul>
        </div>
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
                    <input type="radio" name="user-type" value="student" class="form-control mr-3">
                    <label class="mr-5"><strong>Student</strong></label>
                    <input type="radio" name="user-type" value="teacher" class="form-control mr-3">
                    <label><strong>Teacher</strong></label>
                </div>

                <input type="submit" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
