<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Set website title -->
    <title> {{ config('app.name') }} @stack('page_name') </title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">

    <script src="{{asset('/js/jquery.min.js')}}"></script>
    @stack('master_header')


</head>
<body>
@if(Route::currentRouteName()!='unavailable')
    @include('layouts.app')
@endif
@if(session('success'))
    @include('shared.success')
@endif
@yield('content')

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<br>
<footer>
    Aplicações Para a Internet 2016/17&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;José
        Carreira - 2130162&nbsp;&nbsp;&nbsp;&nbsp;Marcelo Carvalho - 2150718&nbsp;&nbsp;&nbsp;&nbsp;Pedro Ferreira -
        2151163
</footer>
</body>
</html>