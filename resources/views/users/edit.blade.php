@extends('master')

@include ('layouts.app')

@section('title', 'Add user')

@section('content')
    @if (count($errors) > 0)
        @include ('shared.errors')
    @endif

<form action="{{route('users.update', $user)}}" method="post" class="form-group">
    {{method_field('PUT')}}
    @include('users.partials.add-edit')
    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="ok">Save</button>
        <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
    </div>
</form>
@endsection