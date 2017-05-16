@extends('master')

<script src="/js/sorttable.js"></script>
<script src="/js/filter.js"></script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Requests List</div>
                <div class="panel-body">
                    @if(count($requests))
                        <div class="row">
                            <form>
                                <div class="col-xs-6">
                                    {{ $requests->links() }}
                                    <button type="submit" class="btn btn-success" style="float:right;">Search</button>
                                </div>
                                <div class="col-xs-6">
                                    <input type="text" name="search" id="myInput" placeholder="Search any column..."/>
                                    <a class="btn btn-primary side-offset" href="{{ route('requests.create') }}" style="float: right;">Add request</a>
                                </div>
                            </form>
                        </div>
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
                                @if(!$request->status)
                                    <a class="btn btn-xs btn-success" href="{{route('requests.complete', $request)}}">Complete</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </table>
                    {{$requests->links()}}
                    @else
                        <h3>No requests found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection