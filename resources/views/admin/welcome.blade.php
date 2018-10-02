@extends('template')
@extends('welcome_css')

@section('header')
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
@endsection

@section('content')
    <div id="welcome-bg" class="d-flex justify-content-center align-items-center">
        <div>
            <h1 class="display-3 text-light mb-1">{{config('app.name')}}</h1>
            <p class="h5 text-light text-center mb-3">Administrator</p>

            <form method="POST" action="./admin/login">
                {{csrf_field()}}

                <div class="form-group mb-3">
                    <input type="text" name="username" class="form-control form-control-lg mb-1 is-invalid" placeholder="Username" value="{{old('username')}}">
                    @if($errors->has('username'))
                        <div class="invalid-feedback mb-3">
                            {{ $errors->first('username') }}
                        </div>
                    @endif

                    <input type="password" name="password" class="form-control form-control-lg mb-1 is-invalid" placeholder="Password" >
                    @if($errors->has('password'))
                        <div class="invalid-feedback mb-3">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-around">
                    <div class="form-inline mr-4">
                        <input type="checkbox" class="form-control form-check" name="remember">
                        <label class="text-light"><strong>Remember Me</strong></label>
                    </div>
                    <input type="submit" class="btn btn-primary flex-fill">
                </div>
            </form>
        </div>
    </div>
@endsection
