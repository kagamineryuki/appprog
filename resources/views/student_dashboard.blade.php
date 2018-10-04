@extends('template')
@extends('student_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@section('content-div')
    <h1 class="text-center mt-3 display-4">Scan QR Code</h1>
    <hr>
    <div class="m-4 d-flex justify-content-center align-content-center">
        <video class="align-items-center" id="preview"></video>
    </div>
    <script src="{{asset('js/qrcode.js')}}"></script>
@endsection
@endsection