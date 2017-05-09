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
                            "rgba(103, 109, 108, 0.6)",
                            "rgba(54, 162, 235, 0.5)"
                        ],
                        hoverBackgroundColor: [
                            "rgba(173, 181, 179, 0.8)",
                            "rgba(122, 198, 249, 0.8)"
                        ]
                    }]
            },
            options: {
                animation:{
                    animateScale:true
                }
            }
        });
    </script>
    <div style="width: 25%; height: 25%;"><canvas id="barChart" width="100%" height="100%"></canvas></div>
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
                    scales: {
                        xAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
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
    </body>
</html>
@endsection
