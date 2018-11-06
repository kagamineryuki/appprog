@extends('template')
@extends('admin.dashboard_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')
    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
        <h1 class="display-4">Update Data</h1>
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
                <button class='btn btn-primary mb-3' id ='submit_user' style="visibility: hidden;">Change Data</button>

                {{--<form method="POST" action="/api/update_user_info" id="form" enctype="multipart/form-data">--}}
                    {{--{{csrf_field()}}--}}
                {{--</form>--}}
            </div>
        </div>

        {{--lesson--}}
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">Lesson</h1>
                <div class="form-group mb-3">
                    <label class="mr-3"><strong>Lesson Code</strong></label>
                    <input type="text" class="form-control " name="no_pelajaran" id="no_pelajaran">
                </div>

                <button class="btn-primary btn mb-3" id="retrieve_pelajaran">Retrieve Data</button>

                <hr>

                <div id = "form-pelajaran">

                </div>
                <button class='btn btn-primary mb-3' id ='submit_pelajaran' style="visibility: hidden;">Change Data</button>

                {{--<form method="POST" action="/api/update_user_info" id="form" enctype="multipart/form-data">--}}
                {{--{{csrf_field()}}--}}
                {{--</form>--}}
            </div>
        </div>

        {{--Class--}}
        <div class="d-flex">
            <div class="container">
                <h1 class="display-4">Class</h1>
                <div class="form-group mb-3">
                    <label class="mr-3"><strong>Class Code</strong></label>
                    <input type="text" class="form-control " name="kode_kelas" id="kode_kelas">
                </div>

                <button class="btn-primary btn mb-3" id="retrieve_kelas">Retrieve Data</button>

                <hr>

                <div id = "form-kelas">

                </div>
                <button class='btn btn-primary mb-3' id ='submit_kelas' style="visibility: hidden;">Change Data</button>

                {{--<form method="POST" action="/api/update_user_info" id="form" enctype="multipart/form-data">--}}
                {{--{{csrf_field()}}--}}
                {{--</form>--}}
            </div>
        </div>

    </div>
    <script src="{{asset('js/retrieve_change_user_data.js')}}"></script>
@endsection
@endsection