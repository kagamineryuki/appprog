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
        <video class="align-items-center" id="preview"></video>
    </div>
    {{--<form action="/student/submit_qr" method="POST">--}}
        {{--{{csrf_field()}}--}}
        {{--<input type="text" name="kode_qr" class="form-control" placeholder="kode qr">--}}
        {{--<input type="text" name="nisn" class="form-control" placeholder="nisn">--}}
        {{--<input type="text" name="nign" class="form-control" placeholder="nign">--}}
        {{--<input type="text" name="kode_pelajaran" class="form-control" placeholder="kode pelajaran">--}}
        {{--<input type="text" name="kode_kelas" class="form-control" placeholder="kode kelas">--}}
        {{--<input type="submit" class="btn btn-primary">--}}
    {{--</form>--}}

    <script src="{{asset('js/qrcode.js')}}"></script>
    {{--<script src="{{asset('js/app.js')}}"></script>--}}
@endsection
@endsection