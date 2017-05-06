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
                        <table class="table table-striped">
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
                                <td>{{$request->id}}</td>
                                <td>{{$request->description}}</td>
                                @if($request->status == -1)
                                    <td>Rejected</td>
                                    <td></td>
                                @endif
                                @if($request->status == 0)
                                        <td>Waiting</td>
                                        <td><a class="btn btn-xs btn-success" href="{{route('requests.edit', $request->id)}}">Start</a></td>
                                @endif
                                @if($request->status == 1)
                                    <td>In progress</td>
                                    <td>
                                        <a class="btn btn-xs btn-warning" href="{{route('requests.edit', $request->id)}}">Finish</a>
                                    </td>
                                @endif
                                @if($request->status == 2)
                                    <td>Complete</td>
                                    <td></td>
                                @endif
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