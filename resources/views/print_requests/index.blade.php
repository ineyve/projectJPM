@extends('master')
<script src="/js/sorttable.js"></script>
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
                    {{--<div class="row">
                            <div class="col-xs-6">
                                {{ $requests->links() }}
                            </div>
                            <div class="col-xs-6">--}}
                                <input type="text" id="myInput" onkeyup="filter()" placeholder="Search any column...">
                        {{--</div>
                        </div>--}}
                    <table class="table table-striped table-hover sortable" id="myTable">
                    <thead>
                        <tr>
                            <th class=" sorttable_sorted">Request Number<span id="sorttable_sortfwdind">&nbsp;▾</span></th>
                            <th>Owner ID</th>
                            <th>Owner Name</th>
                            <th>Open Date</th>
                            <th>Status</th>
                            <th class="sorttable_nosort"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($requests as $request)
                        <tr>
                            <td><a href="{{route('requests.details', $request)}}">{{$request->id}}</a></td>
                            <td><a href="{{route('requests.details', $request)}}">{{$request->owner_id}}</a></td>
                            <td><a href="{{route('requests.details', $request)}}">{{$request->user->name}}</a></td>
                            <td><a href="{{route('requests.details', $request)}}">{{$request->date()}}</a></td>
                            <td><a href="{{route('requests.details', $request)}}">{{$request->statusToStr()}}</a></td>
                            <td>
                                @if($request->status == 0)
                                    <a class="btn btn-xs btn-success" href="{{route('requests.status', ['request' => $request, 'status' => 1, 'from' => 0])}}">Accept</a>
                                @endif
                                @if($request->status == 1)
                                    <a class="btn btn-xs btn-warning" href="{{route('requests.status', ['request' => $request, 'status' => 2, 'from' => 0])}}">Progress</a>
                                @endif
                                @if($request->status == 2)
                                    <a class="btn btn-xs btn-primary" href="{{route('requests.status', ['request' => $request, 'status' => 3, 'from' => 0])}}">Ready</a>
                                @endif
                                @if($request->status == 3)
                                    <a class="btn btn-xs btn-info" href="{{route('requests.status', ['request' => $request, 'status' => 4, 'from' => 0])}}">Complete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </table>
                    {{-- $requests->links() --}}
                    @else
                        <h3>No requests found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script type="text/javascript" src="/js/filter.js"></script>