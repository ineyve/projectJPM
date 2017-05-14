@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                        <img class="profile-picture" src="/profile.jpg">
                        <li>Phone Number: {{$user->phone}}</li>
                        <li>E-mail address: {{$user->email}}</li>
                        <li>Department: {{App\Department::find($user->department_id)->name}}</li>
                        <li>Total Requests: {{$user->print_counts}}</li>
                        <li>Member for: {{$user->memberFor()}}</li>
                        <li>Average Satisfaction Grade:
                            @for($i=0; $i < $user->averageRating()-0.5; $i++)
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