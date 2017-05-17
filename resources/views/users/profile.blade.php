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
                Profile (User {{$user->id}})</div>
                <div class="panel-body">
                    <div class="profile" id="profile-user">
                        @if(is_null($user->profile_photo))
                            <img class="profile-picture" src="/profile.jpg">
                        @else
                            <img class="profile-picture" src="/storage/profiles/{{$user->profile_photo}}">
                        @endif
                        <li>About me: {{$user->presentation}}</li>
                        <li>Department: {{App\Department::find($user->department_id)->name}}</li>
                        <li>Phone Number: {{$user->phone}}</li>
                        <li>E-mail address: <a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
                        <li>Personal URL: <a href="{{$user->profile_url}}">{{$user->profile_url}}</a></li>
                        <li>Total Requests: {{$user->print_counts}}</li>
                        <li>Request evaluations: {{$user->print_evals}}</li>
                        <li>Member for: {{$user->memberFor()}}</li>
                        <li>Average Satisfaction Grade:
                            @for($i=0; $i < $user->averageRating(); $i++)
                                <img src="/star.png" style="width:24px;height:24px;">
                            @endfor
                        </li>
                        <li>Admin: {{$user->adminToStr()}}</li>
                        <li>Blocked: {{$user->blockedToStr()}}</li>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
