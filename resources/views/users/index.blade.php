@extends('master')

<script src="/js/sorttable.js"></script>
<script src="/js/filter.js"></script>

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users List</div>
                <div class="panel-body">
                    @if (count($users))
                        <input type="text" id="myInput" onkeyup="filter()" placeholder="Search any column...">
                        <div style="float: right;">
                            <a class="btn btn-primary side-offset" href="{{ route('users.create') }}">Add user</a>
                        </div>
                        <table class="table table-striped sortable" id="myTable">
                            <thead>
                                <tr>
                                    <th class=" sorttable_sorted">ID<span id="sorttable_sortfwdind">&nbsp;▾</span></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Phone</th>
                                    <th class="sorttable_nosort">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{App\Department::find($user->department_id)->name}}</td>
                                    <td>{{$user->phone}}</td>
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
                        <h3>No users found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection