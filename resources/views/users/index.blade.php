@extends('master')

<script src="/js/sorttable.js"></script>
<script src="/js/filter.js"></script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users List</div>
                <form class="panel-body">
                    @if (count($users))
                        <form>
                            <div class="col-xs-6">
                                {{ $users->links() }}
                                <button type="submit" class="btn btn-success" style="float:right;">Search</button>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" name="search" id="myInput" placeholder="Search any column..."/>
                                @if($auth->admin)
                                    <a class="btn btn-primary side-offset" href="{{ route('users.create') }}" style="float: right;">Add user</a>
                                @endif
                            </div>
                        </form>
                        <table class="table table-striped table-hover sortable" id="myTable">
                            <thead>
                                <tr>
                                    <th class=" sorttable_sorted">ID<span id="sorttable_sortfwdind">&nbsp;▾</span></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Phone</th>
                                    @if($auth->admin)
                                        <th class="sorttable_nosort">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td><a href="{{route('users.profile', $user)}}">{{$user->id}}</a></td>
                                    <td><a href="{{route('users.profile', $user)}}">{{$user->name}}</a></td>
                                    <td><a href="{{route('users.profile', $user)}}">{{$user->email}}</a></td>
                                    <td><a href="{{route('users.profile', $user)}}">{{$user->department->name}}</a></td>
                                    <td><a href="{{route('users.profile', $user)}}">{{$user->phone}}</a></td>
                                    @if($auth->admin)
                                    <td><a href="{{route('users.profile', $user)}}">
                                        <a class="btn btn-xs btn-primary" href="{{ route('users.edit', $user) }}">Edit</a>
                                        @if($user != $auth)
                                            @if(!$user->blocked)
                                                <a class="btn btn-xs btn-warning" href="{{ route('users.block', ['user' => $user, 'block' => 1]) }}">Block</a>
                                            @else
                                                <a class="btn btn-xs btn-success" href="{{ route('users.block', ['user' => $user, 'block' => 0]) }}">Unblock</a>
                                            @endif
                                        @endif
                                    </a></td>
                                    @endif
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