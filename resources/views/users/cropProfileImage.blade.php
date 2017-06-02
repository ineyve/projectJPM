@extends('master')
@push('page_name') - Edit Profile @endpush
@push('master_header')
<script type="text/javascript">
    $(window).load(function () {
        $.getScript("/jcrop/js/jquery.Jcrop.js", function () {

            $(function () {

                $('#cropbox').Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords
                });

            });

            function updateCoords(c) {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
            }

            function checkCoords() {
                if (parseInt($('#w').val())) return true;
                alert('Please select a crop region then press submit.');
                return false;
            }
        });
    });
</script>
<link rel="stylesheet" href="/jcrop/css/jquery.Jcrop.css" type="text/css"/>

@endpush
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Crop Photo</div>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-6" style="text-align:center;">
                    <!-- This is the image we're attaching Jcrop to -->
                    <br>
                    <img src="/storage/profiles/{{$user->profile_photo}}" id="cropbox" alt="Image failed to load">
                    <!-- This is the form that our event handler fills -->
                    <form action="{{route('image.crop', $user)}}" method="post" onsubmit="return checkCoords();"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" id="x" name="x"/>
                        <input type="hidden" id="y" name="y"/>
                        <input type="hidden" id="w" name="w"/>
                        <input type="hidden" id="h" name="h"/>
                        <input type="submit" value="Crop Image" class="btn btn btn-success" id="btn-crop">
                    </form>
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