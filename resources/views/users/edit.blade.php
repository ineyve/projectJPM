@extends('master')

@section('content')
    <form action="{{route('users.update', $user)}}" method="post" class="form-group">
        {{method_field('PUT')}}
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Edit User</div>
                        <div class="panel-body">
                            @include('users.partials.add-edit')
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary side-offset" name="ok">Save</button>
                                <a type="submit" class="btn btn-default" href="{{route('users.index')}}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection