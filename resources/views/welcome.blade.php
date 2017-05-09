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
    <div class="home-box">
        <div class="home-counter">{{$statistics['requestscount']}} <h1 class="h-h1">documents printed so far</h1></div>
    <div style="width: 25%; height: 25%;"><canvas id="colorChart" width="100%" height="100%"></canvas></div>
    <script>
        var colorctx = document.getElementById("colorChart");
        var colorChart = new Chart(colorctx, {
            type: 'pie',
            data: {
                labels: [
                    "Grayscale",
                    "Color"
                ],
                datasets: [
                    {
                        data: [{{$statistics['grayscale']}}, {{$statistics['colored']}}],
                        backgroundColor: [
                            "rgb(128, 128, 128)",
                            "rgb(30, 144, 255)"
                        ],
                        hoverBackgroundColor: [
                            "rgb(155, 155, 155)",
                            "rgb(100, 149, 237)"
                        ]
                    }]
            },
            options: {
                labels: [{
                    fontSize: 18
                }],
                animation:{
                    animateScale:true
                }
            }
        });
    </script>
        <div style="width: 40%; height: 25%;"><canvas id="barChart" width="200%" height="100%"></canvas></div>
        <script>
            var ctx = document.getElementById("barChart");
            var barChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: {!! $statistics['departments'] !!},
                    datasets: [{
                        label: '# prints',
                        data: {!! $statistics['departmentscount'] !!},
                        backgroundColor: {!! $statistics['departmentscolor'] !!},
                        borderColor: {!! $statistics['departmentscolor'] !!},
                        borderWidth: 1
                    }]
                },
                options: {
                    defaultFontFamily: Chart.defaults.global.defaultFontFamily = "'Lobster'",
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
    <!--
    <div class="home-counter"> *****RASCUNHO*****  </div>

        Documents printed today:
        <div class="home-counter">
            253
        </div>

        Average prints per day (this month):
        <div class="home-counter">
            253
        </div>
        -->
</html>
@endsection
