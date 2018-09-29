@extends('template')
@extends('welcome_css')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
    <body>
    <div id="welcome-bg" class="d-flex justify-content-center align-items-center">
        <div>
            <h1 class="display-3 text-light">{{config('app.name')}}</h1>

            {!! Form::open(['url' => 'foo/bar']) !!}
            {{Form::text('username', '',['class' => 'form-control form-control-lg', 'placeholder' => 'Username'])}}
            {{Form::password('password',['class' => 'form-control form-control-lg', 'placeholder' => 'Password'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
