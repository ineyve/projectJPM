@extends('master')

@section('content')
<div>
    <a class="btn btn-primary offset" href="{{route('requests.create')}}">Add Request</a>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Requests List</div>
                <div class="panel-body">
                    @if(count($requests))
                        <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td><a href="{{route('requests.details', $request)}}">{{$request->id}}</a></td>
                                <td><a href="{{route('requests.details', $request)}}">{{$request->description}}</a></td>
                                <td>
                                @if($request->status == -1)
                                        <a href="{{route('requests.details', $request)}}">Rejected</a></td>
                                    <td>
                                @endif
                                @if($request->status == 0)
                                        <a href="{{route('requests.details', $request)}}">Waiting</a></td>
                                    <td><a class="btn btn-xs btn-success" href="{{route('requests.status', ['request' => $request, 'status' => 1, 'from' => 0])}}">Progress</a>
                                @endif
                                @if($request->status == 1)
                                        <a href="{{route('requests.details', $request)}}">In progress</a></td>
                                    <td><a class="btn btn-xs btn-warning" href="{{route('requests.status', ['request' => $request, 'status' => 2, 'from' => 0])}}">Ready</a>
                                @endif
                                @if($request->status == 2)
                                        <a href="{{route('requests.details', $request)}}">Ready</a></td>
                                    <td><a class="btn btn-xs btn-primary" href="{{route('requests.status', ['request' => $request, 'status' => 3, 'from' => 0])}}">Complete</a>
                                @endif
                                @if($request->status == 3)
                                        <a href="{{route('requests.details', $request)}}">Complete</a></td>
                                    <td>
                                @endif
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    @else
                        <h3>No requests found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection