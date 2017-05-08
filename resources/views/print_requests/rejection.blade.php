@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Rejection Reason (Request {{$request->id}})</div>
                    <div class="panel-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputReason">Reason</label>
                            <input type="text" class="form-control" name="fullname" id="inputReason"/>
                        </div>
                        <button type="submit" class="btn btn-danger" name="ok">Reject</button>
                        <a type="submit" class="btn btn-default" href="{{route('requests.details', $request)}}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
