@include('layouts.app')

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="/glitched_text/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    </head>
    <body>
        <div class="container">
        @if(session('sucess'))
            @include('shared.sucess')
        @endif

        @isset($errors)
            @if(count($errors) > 0)
                @include('shared.errors')
            @endif
        @endisset
        @yield('content')


    </div>

    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <div id="footer"><marquee scrollamount="2">Aplicações Para a Internet 2016/17&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspJosé Carreira - 2130162&nbsp&nbsp&nbsp&nbspMarcelo Carvalho - 2150718&nbsp&nbsp&nbsp&nbspPedro Ferreira - 2151163</marquee></div>
    </body>
</html>
