@extends('template')
@extends('admin.dashboard_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')
    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">Delete Data</h1>
        <hr>
        {{--user--}}
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">User</h1>
                <div class="form-group mb-3">
                    <label class="mr-3"><strong>NISN / NIGN*</strong></label>
                    <input type="text" class="form-control " name="nisn" id="nisn">
                </div>

                <div class="form-inline mb-3">
                    <input type="radio" name="user_type" value="student" class="form-control mr-3 user_type" checked>
                    <label class="mr-5"><strong>Student</strong></label>
                    <input type="radio" name="user_type" value="teacher" class="form-control mr-3 user_type">
                    <label><strong>Teacher</strong></label>
                </div>

                <button class="btn-primary btn mb-3" id="retrieve_user">Retrieve Data</button>

                <hr>

                <div id = "form-change">

                </div>
                <button class='btn btn-danger mb-3' id ='submit_user' style="visibility: hidden;">DELETE</button>

            </div>
        </div>

        {{--lesson--}}
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">Pelajaran</h1>
                <div class="form-group mb-3">
                    <label class="mr-3"><strong>Kode Pelajaran</strong></label>
                    <input type="text" class="form-control " name="no_pelajaran" id="no_pelajaran">
                </div>

                <button class="btn-primary btn mb-3" id="retrieve_pelajaran">Retrieve Data</button>

                <hr>

                <div id = "form-pelajaran">

                </div>
                <button class='btn btn-danger mb-3' id ='submit_pelajaran' style="visibility: hidden;">DELETE</button>

            </div>
        </div>

        {{--Class--}}
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">Kelas</h1>
                <div class="form-group mb-3">
                    <label class="mr-3"><strong>Kode Kelas</strong></label>
                    <input type="text" class="form-control " name="kode_kelas" id="kode_kelas">
                </div>

                <button class="btn-primary btn mb-3" id="retrieve_kelas">Retrieve Data</button>

                <hr>

                <div id = "form-kelas">

                </div>
                <button class='btn btn-danger mb-3' id ='submit_kelas' style="visibility: hidden;">DELETE</button>

            </div>
        </div>

    </div>
    <script src="{{asset('js/retrieve_delete_user_data.js')}}"></script>
@endsection
@endsection