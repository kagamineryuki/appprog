@extends('template')
@extends('teacher.dashboard_template')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
@section('content-div')
    <div class="bg-white container-fluid align-items-stretch p-4" id="contents-dashboard">
    </div>
@endsection
@endsection