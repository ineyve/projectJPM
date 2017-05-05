@extends('master')

@include ('layouts.app')

@section('title', 'List users')

@section('content')
<div>
    <a class="btn btn-primary" href="{{ route('users.create') }}">Add user</a>
</div>

@if (count($users))
    <table class="table table-striped">
    <thead>
        <tr>
            <th>Email</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{$user->email}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->phone}}</td>
            <td>{{App\Department::find($user->department_id)->name}}</td>
            <td>
                <a class="btn btn-xs btn-primary" href="{{ route('users.edit', $user) }}">Edit</a>
                <form action="{{route('users.destroy',$user)}}" method="post" class="inline">
                    {{method_field('DELETE')}}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </table>
@else
    <h2>No users found</h2>
@endif
@endsection