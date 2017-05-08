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
                                @if($request->status == 0)
                                    <tr>
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->id}}</a></td>
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->description}}</a></td>
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->file}}</a></td>
                                        <td><a href="{{route('requests.edit', $request)}}">
                                        @if($request->status == -1)
                                            Rejected
                                        @endif
                                        @if($request->status == 0)
                                            Waiting
                                        @endif
                                        @if($request->status == 1)
                                            In progress
                                        @endif
                                        @if($request->status == 2)
                                            Ready
                                        @endif
                                        @if($request->status == 3)
                                            Complete
                                        @endif
                                        </a></td>
                                        <td></td>
                                    </tr>
                                @else
                                    <td>{{$request->id}}</td>
                                    <td>{{$request->description}}</td>
                                    <td>{{$request->file}}</td>
                                    <td>
                                        @if($request->status == -1)
                                            Rejected
                                        @endif
                                        @if($request->status == 0)
                                            Waiting
                                        @endif
                                        @if($request->status == 1)
                                            In progress
                                        @endif
                                        @if($request->status == 2)
                                            Ready
                                        @endif
                                        @if($request->status == 3)
                                            Complete
                                        @endif
                                    </td>

                                @endif
                                @if($request->status == 3)
                                    <td><img src="/5star.png" style="width:80px;height:15px;"></td>
                                @else
                                    <td></td>
                                @endif
                            </tbody>
                            @endforeach
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