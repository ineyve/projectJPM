@extends('master')

@section('title', 'Add Request')
@section('content')


@if (count($errors) > 0) 
    @include('shared.errors')
@endif

<form action="{{route('requests.store')}}" method="post" class="form-group">
    @include('requests.partials.add-edit')

    <div class="form-group">
        <button type="submit" class="btn btn-primary" name="ok">Add</button>
        <a type="submit" class="btn btn-default" href="{{route('requests.index')}}">Cancel</a>

    </div>
</form>

@endsection



