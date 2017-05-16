@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
            <div class="panel-heading">Edit User</div>
                <div class="panel-body">
                    <form action="{{route('users.updateProfile')}}" method="post" class="form-group" enctype="multipart/form-data">
                    <div class="form-group">
                        {{ csrf_field() }}
                        <div class="form-group" id="name">
                            <label for="inputName">Name</label>
                            <input
                                    type="text" class="form-control"
                                    name="name" id="inputName"
                                    placeholder="Name" value="{{old('name', $user->name)}}" />
                        </div>
                        <div class="form-group" id="email">
                            <label for="inputEmail">Email</label>
                            <input
                                    type="email" class="form-control"
                                    name="email" id="inputEmail"
                                    placeholder="Email address" value="{{old('email', $user->email)}}"/>
                        </div>
                        <div class="form-group" id="phone">
                            <label for="inputPhone">Phone</label>
                            <input
                                    type="tel" class="form-control"
                                    name="phone" id="inputPhone"
                                    placeholder="Phone" value="{{old('phone', $user->phone)}}" />
                        </div>
                        <div class="form-group" id="photo">
                            <label for="inputProfile_photo">Profile Photo</label>
                            <input type="file" class="form-control" name="profile_photo" id="inputProfile_photo" accept="image/*" value="{{old('profile_photo')}}"/>
                        </div>
                        <div class="form-group" id="about">
                            <label for="inputPresentation">About Me</label>
                            <textarea class="form-control" name="presentation" id="inputPresentation">{{old('presentation', $user->presentation)}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary side-offset" id="buttonSave">Save</button>
                        <a type="submit" class="btn btn-default" href="{{route('dashboard')}}" id="buttonCancel">Cancel</a>
                        <a class="btn btn-warning" href='javascript:showPassword()' id="buttonComment" style="float:right;">Change Password</a>
                    </div>
                    </form>
                    <form action="{{route('users.updatePassword')}}" method="post" class="form-group">
                        {{method_field('PUT')}}
                        <div class="form-group">
                            {{ csrf_field() }}
                            <div class="form-group" id="original" style="display:none">
                                <label for="inputPassword">Original Password</label>
                                <input
                                        type="password" class="form-control"
                                        name="oldPassword" id="inputPassword"
                                        placeholder="Password"/>
                            </div>
                            <div class="form-group" id="first" style="display:none">
                                <label for="inputPassword">New Password</label>
                                <input
                                        type="password" class="form-control"
                                        name="newPassword" id="inputPassword"
                                        placeholder="Password"/>
                            </div>
                            <div class="form-group" id="confirm" style="display:none">
                                <label for="inputPasswordConfirmation">New Password Confirmation</label>
                                <input
                                        type="password" class="form-control"
                                        name="newPasswordConfirmation" id="inputPasswordConfirmation"
                                        placeholder="Password Confirmation"/>
                            </div>
                            <button type="submit" class="btn btn-primary side-offset" name="ok" id="submit" style="display:none">Save Password</button>
                            <a class="btn btn-default" href='javascript:hidePassword()' id="buttonHide" style="display:none">Cancel</a>
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
        $('#original').show();
        $('#first').show();
        $('#confirm').show();
        $('#submit').show();
        $('#buttonHide').show();
        $('#buttonComment').hide();
        $('#buttonSave').hide();
        $('#buttonCancel').hide();
        $('#name').hide();
        $('#email').hide();
        $('#phone').hide();
        $('#photo').hide();
        $('#about').hide();
    }
</script>
<script>function hidePassword(){
        $('#original').hide();
        $('#first').hide();
        $('#confirm').hide();
        $('#submit').hide();
        $('#buttonHide').hide();
        $('#buttonComment').show();
        $('#buttonSave').show();
        $('#buttonCancel').show();
        $('#name').show();
        $('#email').show();
        $('#phone').show();
        $('#photo').show();
        $('#about').show();
    }
</script>