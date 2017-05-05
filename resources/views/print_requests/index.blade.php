@extends('master')

@include('layouts.app')

@section('content')
<div>
    <a class="btn btn-primary" href="{{route('requests.create')}}">Add Request</a>
</div>

@if(count($requests))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Request Number</th>
            <th>Description</th>
            <th>User ID</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($requests as $request)
        <tr>
            <td>{{$request->id}}</td>
            <td>{{$request->description}}</td>
            <td>{{$request->owner_id}}</td>
            <td>
                <a class="btn btn-xs btn-primary" href="{{route('requests.edit', $request->requestNumber)}}">Edit</a>
            </td>
        </tr>
    @endforeach
    </table>
@else 
    <h2>No requests found</h2>
@endif

@endsection