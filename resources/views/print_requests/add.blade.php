@extends('master')

@section('content')

<form action="{{route('requests.store')}}" method="post" class="form-group" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Request</div>
                    <div class="panel-body">

                        @include('print_requests.partials.add-edit')

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary side-offset" name="ok">Add</button>
                            <a type="submit" class="btn btn-default" href="{{route('requests.index')}}">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection