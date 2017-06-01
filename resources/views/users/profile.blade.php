@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(substr($user->name, -1) == 's')
                            {{$user->name}}'
                        @else
                            {{$user->name}}'s
                        @endif
                        Profile (User {{$user->id}})
                    </div>
                    <div class="panel-body">
                        <div class="profile" id="profile-user">
                            @include('users.partials.profileInfo')
                            @can('admin')
                                <a id="btn-block" class="btn
                                    @if(!$user->blocked)
                                        btn-warning"
                                           href="{{ route('users.block', ['user' => $user, 'block' => 1]) }}">Block
                                    @else
                                        btn-success"
                                           href="{{ route('users.block', ['user' => $user, 'block' => 0]) }}">Unblock
                                    @endif
                                    </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
