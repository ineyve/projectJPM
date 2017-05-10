@extends('master')

@section('content')
<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Print It</title>

        <script src="/js/Chart.js"></script>

    </head>
    <body>
        <div class="home-box">
            <div class="home-counter">
                @if($statistics['printsTotalCount'] == 1)
                    1<h1 class="h-h1"> document printed so far.</h1>
                @else
                    {{$statistics['printsTotalCount']}} <h1 class="h-h1">documents printed so far.</h1>
                @endif
                <br>
                @if($statistics['printsToday'] == 1)
                    1<h1 class="h-h1"> document printed today.</h1>
                @else
                    {{$statistics['printsToday']}} <h1 class="h-h1">documents printed today.</h1>
                @endif
                <br>
                @if($statistics['printsMonthlyAverage'] == 1)
                    1<h1 class="h-h1">document printed per day this month.</h1>
                @else
                    <h1 class="h-h1">About </h1>{{round($statistics['printsMonthlyAverage'], 2)}} <h1 class="h-h1"> documents printed per day this month.</h1>
                @endif
                <br><br><h1 class="h-h1">Greyscale vs <h1 class="blue-h1">Color</h1></h1>
            </div>
            <div class="piechart"><canvas id="colorChart" width="100%" height="100%"></canvas></div>
            <script>
                var colorctx = document.getElementById("colorChart");
                var colorChart = new Chart(colorctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            "% Color",
                            "% Grayscale"
                        ],
                        datasets: [
                            {
                                data: [{{$statistics['colored']}}, {{$statistics['grayScale']}}],
                                backgroundColor: [
                                    "rgb(30, 144, 255)",
                                    "rgb(128, 128, 128)"
                                ],
                                hoverBackgroundColor: [
                                    "rgb(100, 149, 237)",
                                    "rgb(155, 155, 155)"
                                ]
                            }]
                    },
                    options: {
                        defaultFontFamily: Chart.defaults.global.defaultFontFamily = "'Sansation_Bold'",
                        legend: {
                            display: false
                        },
                        animation:{
                            animateScale:true
                        }
                    }
                });
            </script>
            <div class="home-counter">
                <br><h1 class="h-h1">Prints per department</h1>
            </div>
            <div class="barchart"><canvas id="barChart" width="100%" height="25%"></canvas></div>
            <script>
                var ctx = document.getElementById("barChart");
                var barChart = new Chart(ctx, {
                    type: 'horizontalBar',
                    data: {
                        labels: {!! $statistics['departments'] !!},
                        datasets: [{
                            label: '# prints',
                            data: {!! $statistics['departmentsCount'] !!},
                            backgroundColor: {!! $statistics['departmentsColor'] !!},
                            borderColor: {!! $statistics['departmentsColor'] !!},
                            borderWidth: 1
                        }]
                    },
                    options: {
                        defaultFontFamily: Chart.defaults.global.defaultFontFamily = "'Sansation_Bold'",
                        scales: {
                            xAxes: [{
                                ticks: {
                                    beginAtZero:true,
                                    fontSize: 18
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    fontSize: 18
                                }
                            }]
                        },
                        legend: {
                            display: false
                        }
                    }
                });
            </script>
        </div>
    </body>
</html>
@endsection
