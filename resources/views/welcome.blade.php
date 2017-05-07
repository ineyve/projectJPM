@extends('master')

@section('content')
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Print It</title>

    </head>
    <body>
    <div class="home-counter"> *****RASCUNHO*****  </div>

        Total documents printed:
        <div class="home-counter">
            6520
        </div>

        Documents printed today:
        <div class="home-counter">
            253
        </div>

        Average prints per day (this month):
        <div class="home-counter">
            253
        </div>

        Documents printed by department:
        <div class="home-counter">
            A --------- </br>
            B ---- </br>
            C ------- </br>
            D ------------------ </br>
            E ----------- </br>
            F -- </br>
        </div>

        Grey scale versus color:
        <div class="home-counter">
            (Pie chart)
        </div>
    </body>
</html>
@endsection
