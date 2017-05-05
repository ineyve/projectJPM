@extends('master')
@section('title', 'List Requests')
@section('content')


<div>
    <a class="btn btn-primary" href="{{route('requests.create')}}">Add Request</a>
</div>

@if(count($print_requests))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Request Number</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($print_requests as $request) {
        <tr>
            <td>{{$print_requests->requestNumber}}</td>
            <td>{{$print_requests->description}})</td>
            <td>
                <a class="btn btn-xs btn-primary" href="{{route('requests.edit', $print_requests->requestNumber)}}">Edit</a>
            </td>
        </tr>
    @endforeach
    </table>
@else 
    <h2>No requests found</h2>
@endif

@endsection