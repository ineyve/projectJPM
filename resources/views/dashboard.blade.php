@extends('master')

@section('content')
<div>
    <a class="btn btn-primary offset" href="{{route('requests.create')}}">Add Request</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                @if(substr($user->name, -1) == 's')
                    <div class="panel-heading">{{$user->name}}' Requests</div>
                @else
                    <div class="panel-heading">{{$user->name}}'s Requests</div>
                @endif
                <div class="panel-body">
                    @if (count($requests))
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Description</th>
                                <th>File</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
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
                                            <td><div id="star" class="c-rating"></div></td>
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

<script src="/js/rating.js"></script>
<script>
    var el = document.querySelector('#star');
    var currentRating = {{$request->satisfaction_grade }}
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
                window.location="{{ route('requests.rating', [$request, 'rating' => 5])}}";
        }
    };
    var myRating = rating(el, currentRating, maxRating, callback);
</script>
@endsection
