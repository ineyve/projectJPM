@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$user->name}}'s Requests</div>
                <div class="panel-body">
                    <?php $count = 0; ?>
                    @if (count($requests))
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($requests as $request)
                                @if($request->owner_id == $user->id)
                                    <?php $count++; ?>
                                    <tr>
                                        <td><a href="{{route('requests.edit', $request->id)}}">{{$request->id}}</a></td>
                                        <td><a href="{{route('requests.edit', $request->id)}}">{{$request->description}}</a></td>
                                    </tr>
                                @endif
                            </tbody>
                            @endforeach
                        </table>
                    @endif
                    @if($count == 0)
                        <h3>You have no active requests</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection