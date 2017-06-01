@extends('master')
@push('page_name') - Users @endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Blocked Users</div>
                    <div class="panel-body">
                        {{ $users->links() }}
                        @if (count($users))
                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><a href="{{route('users.profile', $user)}}">{{$user->id}}</a></td>
                                        <td><a href="{{route('users.profile', $user)}}">{{$user->name}}</a></td>
                                        <td><a href="{{route('users.profile', $user)}}">{{$user->email}}</a></td>
                                        <td><a href="{{route('users.profile', $user)}}">{{$user->department->name}}</a>
                                        </td>
                                        <td><a href="{{route('users.profile', $user)}}">{{$user->phone}}</a></td>
                                        <td><a href="{{route('users.profile', $user)}}">
                                        <a class="btn btn-xs btn-success"
                                           href="{{ route('users.block', ['user' => $user, 'block' => 0]) }}">Unblock</a>
                                            </a></td>
                                    </tr>
                                @endforeach
                            </table>
                            {{ $users->links() }}
                        @else
                            <h3>No users found</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection