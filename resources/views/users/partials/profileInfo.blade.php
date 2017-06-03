@if(is_null($user->profile_photo))
    <img class="profile-picture" src="/profile.jpg" alt="Image failed to load">
@else
    <img class="profile-picture" src="/storage/profiles/{{$user->profile_photo}}" alt="Image failed to load">
@endif
<p>E-mail address: <a href="mailto:{{$user->email}}">{{$user->email}}</a></p>
@if(!is_null($user->phone))
    <p>Phone Number: {{$user->phone}}</p>
@endif
<p>Department: {{$user->department->name}}</p>
@if(!is_null($user->profile_url))
    <p>Personal URL: <a href="{{$user->profile_url}}">{{$user->profile_url}}</a></p>
@endif
@if(!is_null($user->presentation))
    <p>About me: {{$user->presentation}}</p>
@endif
@if(Auth::User()->admin || $user->id == Auth::User()->id)
    <p>Completed Quantity: {{$user->print_counts}}</p>
    <p>Request evaluations: {{$user->print_evals}}</p>
    <p>Member for: {{$user->memberFor()}}</p>
    <p>Average Satisfaction Grade:
        @for($i=0; $i < $user->averageRating(); $i++)
            <img src="/star.png" style="width:24px;height:24px;" alt="Image failed to load">
        @endfor
    </p>
    <p>Admin: {{$user->adminToStr()}}</p>
    <p>Blocked: {{$user->blockedToStr()}}</p>
@endif