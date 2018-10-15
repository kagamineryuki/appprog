@extends('template')
@extends('student_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')
    <h1 class="text-center mt-3 display-4">Scan QR Code</h1>
    <hr>
    <div class="m-4 d-flex justify-content-center align-content-center">
        <video class="align-items-center w-100" id="preview"></video>
    </div>
    <div class="container">
        <h1 class="text-center h3">Can't scan the code ?</h1>
        <p class="text-center">Input the code below</p>
        <form action="./submit_qr" method="POST">
            {{csrf_field()}}
            <input type="text" name="kode_qr" class="form-control mb-2" placeholder="QR Code Subtitution">
            <input type="hidden" name="nisn" value="{{auth()->guard('student')->user()->nisn}}">
            <div class="d-flex justify-content-center align-content-center">
                <input type="submit" class="btn btn-primary flex-fill">
            </div>
        </form>
    </div>
    <hr>
    <div class="container">
        {{--<div>--}}
            {{--<h1 class="text-center h3"><strong>Attendances History</strong></h1>--}}
            {{--<p class="text-center">All your attendances listed below</p>--}}
        {{--</div>--}}
        {{--<div class="d-flex justify-content-center">--}}
            {{--<table class="table table-striped">--}}
                {{--<thead class="thead-dark">--}}
                {{--<tr>--}}
                    {{--<th>Student Name</th>--}}
                    {{--<th>Class</th>--}}
                    {{--<th>Lesson</th>--}}
                    {{--<th>Teacher Name</th>--}}
                    {{--<th>Created At</th>--}}
                    {{--<th>Valid Until</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                    {{--@foreach($data as $attendance)--}}
                        {{--<tr>--}}
                            {{--<td>{{$attendance->student_name}}</td>--}}
                            {{--<td>{{$attendance->nama_kelas}}</td>--}}
                            {{--<td>{{$attendance->nama_pelajaran}}</td>--}}
                            {{--<td>{{$attendance->teacher_name}}</td>--}}
                            {{--<td>{{$attendance->created_at}}</td>--}}
                            {{--<td>{{$attendance->valid_until}}</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
    </div>

    <script src="{{asset('js/qrcode.js')}}"></script>
    {{--<script src="{{asset('js/app.js')}}"></script>--}}
@endsection
@endsection