@if(is_null($user->profile_photo))
    <img class="profile-picture" src="/profile.jpg">
@else
    <img class="profile-picture" src="/storage/profiles/{{$user->profile_photo}}">
@endif
<li>E-mail address: <a href="mailto:{{$user->email}}">{{$user->email}}</a></li>
@if(!is_null($user->phone))
    <li>Phone Number: {{$user->phone}}</li>
@endif
<li>Department: {{$user->department->name}}</li>
@if(!is_null($user->profile_url))
    <li>Personal URL: <a href="{{$user->profile_url}}">{{$user->profile_url}}</a></li>
@endif
@if(!is_null($user->presentation))
    <li>About me: {{$user->presentation}}</li>
@endif
@can('selfOrAdmin')
    <li>Completed Quantity: {{$user->print_counts}}</li>
    <li>Request evaluations: {{$user->print_evals}}</li>
    <li>Member for: {{$user->memberFor()}}</li>
    <li>Average Satisfaction Grade:
        @for($i=0; $i < $user->averageRating(); $i++)
            <img src="/star.png" style="width:24px;height:24px;">
        @endfor
    </li>
    <li>Admin: {{$user->adminToStr()}}</li>
    <li>Blocked: {{$user->blockedToStr()}}</li>
@endcan