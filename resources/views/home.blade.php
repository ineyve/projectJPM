@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">

                        <a class="btn btn-primary" href="{{ route('requests.index') }}">
                            Requests list
                        </a>

                        <a class="btn btn-primary" href="{{ route('users.index') }}">
                            Users list
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
