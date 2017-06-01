@extends('master')
@push('page_name') - Edit Profile @endpush
@push('master_header')
<script>
    function showPassword() {
        $('#password-form').show();
        $('#profile-form').hide();
    }
</script>
<script>
    function hidePassword() {
        $('#password-form').hide();
        $('#profile-form').show();
    }
</script>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit User</div>
                    <div class="panel-body">
                        <form action="{{route('users.updateProfile')}}" method="post" class="form-group"
                              enctype="multipart/form-data" id="profile-form">
                            <div class="form-group">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="inputName" class="control-label">Name</label>
                                    <input
                                            type="text" class="form-control"
                                            name="name" id="inputName"
                                            placeholder="Name" value="{{old('name', $user->name)}}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="inputPhone" class="control-label">Phone</label>
                                    <input type="tel" class="form-control" name="phone" placeholder="Phone"
                                           value="{{old('phone', $user->phone)}}" required>
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="department_id">Department</label>
                                    <select name="department_id" id="inputDepartment" class="form-control">
                                        @foreach($departments as $department)
                                            @if(old('department_id') != null)
                                                @if(old('department_id') == $department->id)
                                                    <option selected="selected"
                                                            value="{{$department->id}}">{{$department->name}}</option>
                                                @else
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endif
                                            @else
                                                @if($user->department_id == $department->id)
                                                    <option selected="selected"
                                                            value="{{$department->id}}">{{$department->name}}</option>
                                                @else
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endif
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group{{ $errors->has('profile_url') ? ' has-error' : '' }}">
                                    <label for="inputProfile_url" class="control-label">Profile Url</label>
                                    <input type="text" class="form-control" name="profile_url"
                                           value="{{old('profile_url', $user->profile_url)}}">
                                    @if ($errors->has('profile_url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('profile_url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @if(!(is_null($user->profile_photo)))
                                    <a href="{{ route('image.config', $user) }}" class="btn btn-success">Crop</a>
                                @endif
                                <div class="form-group{{ $errors->has('profile_photo') ? ' has-error' : '' }}">
                                    <label for="inputProfile_photo" class="control-label">Profile Photo</label>
                                    <input type="file" class="form-control" name="profile_photo"
                                           accept="image/*" value="{{old('profile_photo')}}">
                                    @if ($errors->has('profile_photo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('profile_photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('presentation') ? ' has-error' : '' }}">
                                    <label for="inputPresentation" class="control-label">About Me</label>
                                    <textarea class="form-control"
                                              name="presentation">{{old('presentation', $user->presentation)}}</textarea>
                                    @if ($errors->has('presentation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('presentation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary side-offset">Save</button>
                                <a type="submit" class="btn btn-default" href="{{route('dashboard')}}">Cancel</a>
                                <a class="btn btn-warning" href='javascript:showPassword()' style="float:right;">Change
                                    Password</a>
                            </div>
                        </form>
                        <form action="{{route('users.updatePassword')}}" method="post" class="form-group"
                              id="password-form" style="display:none">
                            {{method_field('PUT')}}
                            <div class="form-group">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('oldPassword') ? ' has-error' : '' }}">
                                    <label for="inputPassword" class="control-label">Original Password</label>
                                    <input type="password" class="form-control" name="oldPassword" id="inputPassword"
                                           placeholder="Password" required autofocus>
                                    @if ($errors->has('oldPassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('oldPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('newPassword') ? ' has-error' : '' }}">
                                    <label for="inputPassword" class="control-label">New Password</label>
                                    <input type="password" class="form-control" name="newPassword" id="inputPassword"
                                           placeholder="Password" required>
                                    @if ($errors->has('newPassword'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('newPassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('newPasswordConfirmation') ? ' has-error' : '' }}">
                                    <label for="inputPasswordConfirmation" class="control-label">New Password
                                        Confirmation</label>
                                    <input type="password" class="form-control" name="newPasswordConfirmation"
                                           id="inputPasswordConfirmation" placeholder="Password Confirmation" required>
                                    @if ($errors->has('newPasswordConfirmation'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('newPasswordConfirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary side-offset">Save Password</button>
                                <a class="btn btn-default" href='javascript:hidePassword()'>Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($errors))
        @if($errors->has('oldPassword') || $errors->has('newPassword') || $errors->has('newPasswordConfirmation'))
            <script type='text/javascript'>window.onload = showPassword();</script>
        @endif
    @endif
@endsection