@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>
                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}" >

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department_id" class="col-md-4 control-label">Department</label>
                            <div class="col-md-6">
                                <select name="department_id" id="inputDepartment" class="form-control">
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('profile_photo') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Profile Photo</label>
                            <div class="col-md-6">
                                <input style="padding:0;" id="profile_photo" type="file" class="form-control" name="profile_photo" accept="image/*" value="{{old('profile_photo')}}"/>

                                @if ($errors->has('profile_photo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile_photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>     

                        <div class="form-group{{ $errors->has('profile_url') ? ' has-error' : '' }}">
                            <label for="profile_url" class="col-md-4 control-label">Profile Url</label>
                            <div class="col-md-6">
                                <input id="profile_url" type="link" class="form-control" name="profile_url" value="{{old('profile_url')}}"/>

                                @if ($errors->has('profile_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('profile_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>    

                        <div class="form-group{{ $errors->has('presentation') ? ' has-error' : '' }}">
                            <label for="presentation" class="col-md-4 control-label">About Me</label>
                            <div class="col-md-6">
                                <input id="presentation" type="text" class="form-control" name="presentation" value="{{old('presentation')}}"/>

                                @if ($errors->has('presntation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('presentation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
