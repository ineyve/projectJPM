@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->name}}'s Requests</div>
                <div class="panel-body">
                    @if (count($requests))
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td><a href="{{route('requests.edit', $request->id)}}">{{$request->id}}</a></td>
                                    <td><a href="{{route('requests.edit', $request->id)}}">{{$request->description}}</a></td>
                                </tr>
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