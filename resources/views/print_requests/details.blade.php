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
                                <td>Owner ID</td>
                                <td>{{$request->owner_id}}</td>
                            </tr>
                            @if($request->description != null)
                                <tr>
                                    <td>Description</td>
                                    <td>{{$request->description}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Status</td>
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
                            </tr>
                            <tr>
                                <td>Open Date</td>
                                <td>{{$request->open_date}}</td>
                            </tr>
                            @if($request->due_date != null)
                                <tr>
                                    <td>Due Date</td>
                                    <td>{{$request->due_date}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Quantity</td>
                                <td>{{$request->quantity}}</td>
                            </tr>
                            <tr>
                                <td>Colored</td>
                                <td>
                                    @if($request->colored == 0)
                                        True
                                    @else
                                        False
                                    @endif
                                </td>
                            </tr>
                                <tr>
                                    <td>Stapled</td>
                                    <td>
                                        @if($request->stapled == 0)
                                            True
                                        @else
                                            False
                                        @endif
                                    </td>
                                </tr>
                            <tr>
                                <td>Paper Size</td>
                                <td>A{{$request->paper_size}}</td>
                            </tr>
                            <tr>
                                <td>Paper Type</td>
                                <td>
                                    @if($request->paper_type == 0)
                                        Normal
                                    @endif
                                    @if($request->paper_type == 1)
                                        Journal
                                    @endif
                                    @if($request->paper_type == 2)
                                        Colored
                                    @endif
                                    @if($request->paper_type == 3)
                                        Photographic
                                    @endif
                                    @if($request->paper_type == 4)
                                        Postcard
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>File</td>
                                <td>{{$request->file}}</td>
                            </tr>
                            @if($request->printer_id != null)
                                <tr>
                                    <td>Printer ID</td>
                                    <td>{{$request->printer_id}}</td>
                                </tr>
                            @endif
                            @if($request->closed_date != null)
                                <tr>
                                    <td>Closed Date</td>
                                    <td>{{$request->closed_date}}</td>
                                </tr>
                            @endif
                            @if($request->closed_user_id != null)
                                <tr>
                                    <td>Closed By User</td>
                                    <td>{{$request->closed_user_id}}</td>
                                </tr>
                            @endif
                            @if($request->refused_reason != null)
                                <tr>
                                    <td>Refused Reason</td>
                                    <td>{{$request->refused_reason}}</td>
                                </tr>
                            @endif
                            @if($request->satisfaction_grade != null)
                                <tr>
                                    <td>Satisfaction Grade</td>
                                    <td>
                                        @for($i=0; $i < $request->satisfaction_grade; $i++)
                                            <img src="/star.png" style="width:15px;height:15px;">
                                        @endfor
                                    </td>
                                </tr>
                                @endif
                            @if($request->created_at != null)
                                <tr>
                                    <td>Created</td>
                                    <td>{{$request->created_at}}</td>
                                </tr>
                            @endif
                            @if($request->updated_at != null)
                                <tr>
                                    <td>Last Update</td>
                                    <td>{{$request->updated_at}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    @if($request->status == 0)
                        <a class="btn btn-danger side-offset" href="{{route('requests.create')}}">Reject</a>
                        <a class="btn btn-info" href="{{route('requests.status', ['request' => $request, 'status' => 1, 'from' => 1])}}">Progress</a>
                    @endif
                    @if($request->status == 1)
                        <a class="btn btn-primary" href="{{route('requests.status', ['request' => $request, 'status' => 2, 'from' => 1])}}">Ready</a>
                    @endif
                    @if($request->status == 2)
                        <a class="btn btn-success" href="{{route('requests.status', ['request' => $request, 'status' => 3, 'from' => 1])}}">Complete</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection