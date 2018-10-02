<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset("css/app.css")}}">
    @yield('header')
</head>

<body>
    @yield('content')
</body>
</html>
