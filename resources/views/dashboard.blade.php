@extends('master')

<script src="/js/sorttable.js"></script>
<script src="/js/filter.js"></script>

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @if(substr($user->name, -1) == 's')
                    <div class="panel-heading">{{$user->name}}' Profile</div>
                @else
                    <div class="panel-heading">{{$user->name}}'s Profile</div>
                @endif
                <div class="panel-body">
                    <div class="profile">
                        <h1 style="float: right;">foto</h1>
                        <p>Telefone</p>
                        <p>e-mail</p>
                        <p>Total Requests</p>
                        <p>Member for 3 years</p>
                        <p>Average Satisfaction Grade?</p>
                    </div>
                    <div style="float: right;">
                        <a class="btn btn-success side-offset" href="{{route('requests.create')}}">Edit Profile</a>
                        <a class="btn btn-primary" href="{{route('requests.create')}}">Add Request</a>
                    </div>
                    @if (count($requests))
                        <input type="text" id="myInput" onkeyup="filter()" placeholder="Search any column...">
                        <table class="table table-striped sortable table-hover" id="myTable">
                            <thead>
                            <tr>
                                <th class=" sorttable_sorted">Request Number<span id="sorttable_sortfwdind">&nbsp;▾</span></th>
                                <th>Description</th>
                                <th>File</th>
                                <th>Status</th>
                                <th class="sorttable_nosort"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach ($requests as $request)
                                <tr>
                                    @if($request->status == 0)
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->id}}</a></td>
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->description}}</a></td>
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->file}}</a></td>
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->statusToStr()}}</a></td>
                                    @else
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->id}}</a></td>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->description}}</a></td>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->file}}</a></td>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->statusToStr()}}</a></td>
                                    @endif
                                        @if($request->status == 4)
                                            @if($request->satisfaction_grade == '')
                                                @php($request->satisfaction_grade = 0)
                                            @endif
                                            <td><div id="star{{++$i}}" class="c-rating"></div></td>
                                        @elseif($request->status == -1)
                                            <td><form action="{{route('requests.destroy',$request)}}" method="post" class="inline">
                                                    {{method_field('DELETE')}}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                                </form></td>
                                        @else
                                            <td></td>
                                        @endif
                                </tr>
                                <script src="/js/rating.js"></script>
                                <script>
                                    var el = document.querySelector('#star{{$i}}');
                                    var currentRating={{$request->satisfaction_grade}}
                                    var maxRating= 5;
                                    var callback = function(rating) {
                                        switch(rating) {
                                            case 1:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 1])}}";
                                                break;
                                            case 2:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 2])}}";
                                                break;
                                            case 3:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 3])}}";
                                                break;
                                            case 4:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 4])}}";
                                                break;
                                            default:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 5])}}";
                                        }
                                    };
                                    var myRating = rating(el, currentRating, maxRating, callback);
                                </script>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>You have no active requests</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
