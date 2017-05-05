@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Logged in as {{$user->name}}</div>
                <div class="panel-body">

                    @if (count($requests))
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($requests as $request)
                            <tr class='clickable-row' data-href="{{route('requests.edit', $request->id)}}">
                                <td>{{$request->id}}</td>
                                <td>{{$request->description}}</td>
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