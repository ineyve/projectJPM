@extends('master')
@section('title', 'List Requests')
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
        </tr>
    </thead>
    <tbody>
    @foreach ($requests as $request) {
        <tr>
            <td>{{$request->requestNumber}}</td>
            <td>{{$request->description}})</td>
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