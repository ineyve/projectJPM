@extends('master')

@section('content')
    @push('master_header')
    <script src="{{asset('/js/Chart.js')}}"></script>
    @endpush
    <div class="container">
        <div class="home-box">
            <div class="home-counter">
                <form>
                    <div class="form-group">
                        <select name="department" id="inputDepartmentHome" class="form-control"
                                onchange="this.form.submit()">
                            <option value="0">All Departments</option>
                            @foreach($departments as $department)
                                <option value="{{$department->id}}"
                                        @if(isset($selected) && $selected == $department->id)
                                        selected="selected"
                                        @endif
                                >{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
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
                    <h1 class="h-h1">About </h1>{{round($statistics['printsMonthlyAverage'], 2)}} <h1 class="h-h1">
                        documents printed per day this month.</h1>
                @endif
                <br>
            </div>
            <div class="row">
                <div @if(isset($selected) && $selected == 0) class="col-xs-6 mobile-graph" @endif>
                    <div class="home-counter">
                        <h1 class="h-h1">Greyscale vs</h1>
                        <h1 class="blue-h1">Color</h1>
                    </div>
                    <div class="piechart @if(isset($selected) && $selected != 0) smallerChart @endif">
                        <canvas id="colorChart"></canvas>
                    </div>
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
                                animation: {
                                    animateScale: true
                                }
                            }
                        });
                    </script>
                </div>
                @if(isset($selected) && $selected == 0)
                    <div class="col-xs-6 mobile-graph">
                        <div class="home-counter">
                            <h1 class="h-h1">Prints per department</h1>
                        </div>
                        <div class="barchart">
                            <canvas id="barChart"></canvas>
                        </div>
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
                                                beginAtZero: true,
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
                @endif
            </div>
        </div>
        <br>
    </div>
@endsection
