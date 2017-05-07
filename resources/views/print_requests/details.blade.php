@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Request {{$request->id}}</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Property</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{$request->id}}</td>
                            </tr>
                            <tr>
                                <td>Owner ID</td>
                                <td>{{$request->owner_id}}</td>
                            </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{$request->description}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            @if($request->status == 0)
                                <td>Waiting</td>
                            @endif
                            @if($request->status == 1)
                                <td>In progress</td>
                            @endif
                            @if($request->status == 2)
                                <td>Ready</td>
                            @endif
                            @if($request->status == 3)
                                <td>Complete</td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                    @if($request->status == 0)
                        <a class="btn btn-danger side-offset" href="{{route('requests.create')}}">Reject</a>
                        <a class="btn btn-info" href="{{route('requests.edit', $request)}}">Progress</a>
                    @endif
                    @if($request->status == 1)
                        <a class="btn btn-primary" href="{{route('requests.edit', $request)}}">Ready</a>
                    @endif
                    @if($request->status == 2)
                        <a class="btn btn-success" href="{{route('requests.edit', $request)}}">Complete</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection