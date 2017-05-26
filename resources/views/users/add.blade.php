@extends('master')

@section('content')
    <form action="{{route('users.store')}}" method="post" class="form-group">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Add User</div>
                        <div class="panel-body">
                            @include('users.partials.add-edit')
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary side-offset" name="ok">Add</button>
                                <a type="submit" class="btn btn-default" href="{{route('users.index')}}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection