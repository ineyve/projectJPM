@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Users List</div>
                <div class="panel-body">
                    @if (count($users))

                            <div class="col-xs-6">
                                {{ $users->links() }}
                            </div>
                            <div class="col-xs-6">
                                <form>
                                    <button type="submit" class="btn btn-default btn-search"><span class="glyphicon glyphicon-search search-icon"></span></button>
                                    <input type="text" name="search" id="myInput" placeholder="Search any column..."/>
                                </form>
                                @if($auth->admin)
                                        <a class="btn btn-primary" href="{{ route('users.create') }}" style="float: right;">Add user</a>
                                @endif
                                {{--<input type="hidden" name="field" value="{{$sort['field']}}"/>
                                <input type="hidden" name="order" value="{{$sort['order']}}"/>--}}
                            </div>
                        <table class="table table-striped table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                                <input type="hidden" name="field" value="users.id"/> <!-- table column name -->
                                            @if($sort['field']=='users.id') <!-- table column name -->
                                                @if($sort['order']=='ASC')
                                                    <button type="submit" name="order" value="DESC" class="btn-link">ID ▾</button>
                                                @elseif($sort['order']=='DESC')
                                                    <button type="submit" name="order" value="ASC" class="btn-link">ID ▴</button>
                                                @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">ID</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="users.name"/> <!-- table column name -->
                                            @if($sort['field']=='users.name') <!-- table column name -->
                                                @if($sort['order']=='ASC')
                                                    <button type="submit" name="order" value="DESC" class="btn-link">Name ▾</button>
                                                @elseif($sort['order']=='DESC')
                                                    <button type="submit" name="order" value="ASC" class="btn-link">Name ▴</button>
                                                @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Name</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="users.email"/> <!-- table column name -->
                                            @if($sort['field']=='users.email') <!-- table column name -->
                                                @if($sort['order']=='ASC')
                                                    <button type="submit" name="order" value="DESC" class="btn-link">Email ▾</button>
                                                @elseif($sort['order']=='DESC')
                                                    <button type="submit" name="order" value="ASC" class="btn-link">Email ▴</button>
                                                @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Email</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="departments.name"/> <!-- table column name -->
                                            @if($sort['field']=='departments.name') <!-- table column name -->
                                                @if($sort['order']=='ASC')
                                                    <button type="submit" name="order" value="DESC" class="btn-link">Department ▾</button>
                                                @elseif($sort['order']=='DESC')
                                                    <button type="submit" name="order" value="ASC" class="btn-link">Department ▴</button>
                                                @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Department</button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="users.phone"/> <!-- table column name -->
                                            @if($sort['field']=='users.phone') <!-- table column name -->
                                                @if($sort['order']=='ASC')
                                                    <button type="submit" name="order" value="DESC" class="btn-link">Phone ▾</button>
                                                @elseif($sort['order']=='DESC')
                                                    <button type="submit" name="order" value="ASC" class="btn-link">Phone ▴</button>
                                                @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Phone</button>
                                            @endif
                                        </form>
                                    </th>
                                    @can('admin')
                                        <th>Actions</th>
                                    @endcan
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
                                    @can('admin')
                                    <td><a href="{{route('users.profile', $user)}}">
                                        <a class="btn btn-xs btn-primary" href="{{ route('users.edit', $user) }}">Edit</a>
                                        @if($auth != $user)
                                            @if(!$user->blocked)
                                                <a class="btn btn-xs btn-warning" href="{{ route('users.block', ['user' => $user, 'block' => 1]) }}">Block</a>
                                            @else
                                                <a class="btn btn-xs btn-success" href="{{ route('users.block', ['user' => $user, 'block' => 0]) }}">Unblock</a>
                                            @endif
                                        @endif
                                    </a></td>
                                    @endcan
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