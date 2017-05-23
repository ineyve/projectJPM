@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading">Edit User</div>
                <div class="panel-body">
                    <form action="{{route('users.updateProfile')}}" method="post" class="form-group" enctype="multipart/form-data" id="profile-form">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <input
                                    type="text" class="form-control"
                                    name="name" id="inputName"
                                    placeholder="Name" value="{{old('name', $user->name)}}" />
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">Phone</label>
                            <input type="tel" class="form-control" name="phone" placeholder="Phone" value="{{old('phone', $user->phone)}}"/>
                        </div>

                        <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                            <label for="department_id" class="col-md-4 control-label">Department</label>
                            <select name="department_id" id="inputDepartment" class="form-control">
                                @foreach($departments as $department)
                                    @if($user->department_id == $department->id)
                                        <option selected="selected" value="{{$department->id}}">{{$department->name}}</option>
                                    @else
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputProfile_url">Profile Url</label>
                            <input type="text" class="form-control" name="profile_url" value="{{old('profile_url', $user->profile_url)}}"/>
                        </div>

                        <div class="form-group">
                            <label for="inputProfile_photo">Profile Photo</label>
                            <input style="padding:0;" type="file" class="form-control" name="profile_photo" accept="image/*" value="{{old('profile_photo')}}"/>
                        </div>
                        <div class="form-group">
                            <label for="inputPresentation">About Me</label>
                            <textarea class="form-control" name="presentation">{{old('presentation', $user->presentation)}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary side-offset">Save</button>
                        <a type="submit" class="btn btn-default" href="{{route('dashboard')}}">Cancel</a>
                        <a class="btn btn-warning" href='javascript:showPassword()' style="float:right;">Change Password</a>
                    </div>
                    </form>
                    <form action="{{route('users.updatePassword')}}" method="post" class="form-group" id="password-form" style="display:none">
                        {{method_field('PUT')}}
                        <div class="form-group">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="inputPassword">Original Password</label>
                                <input type="password" class="form-control" name="oldPassword" id="inputPassword" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword">New Password</label>
                                <input type="password" class="form-control" name="newPassword" id="inputPassword" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="input">New Password Confirmation</label>
                                <input type="password" class="form-control" name="newPasswordConfirmation" id="inputPasswordConfirmation" placeholder="Password Confirmation"/>
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
    @if($errors->has('oldPassword') || $errors->has('newPassword'))
        <script type='text/javascript'> window.onload=showPassword(); </script>
    @endif
@endif
@endsection
<script>function showPassword(){
        $('#password-form').show();
        $('#profile-form').hide();
    }
</script>
<script>function hidePassword(){
        $('#password-form').hide();
        $('#profile-form').show();
    }
</script>