@extends('master')

<script src="/js/sorttable.js"></script>
<script src="/js/filter.js"></script>

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
                    <div class="profile">
                        @if(is_null($user->profile_photo))
                            <img class="profile-picture" src="/profile.jpg">
                        @else
                            <img class="profile-picture" src="/storage/profiles/{{$user->profile_photo}}">
                        @endif
                        <li>About me: {{$user->presentation}}</li>
                        <li>Phone Number: {{$user->phone}}</li>
                        <li>E-mail address: {{$user->email}}</li>
                        <li>Department: {{App\Department::find($user->department_id)->name}}</li>
                        <li>Total Requests: {{$user->print_counts}}</li>
                        <li>Member for: {{$user->memberFor()}}</li>
                        <li>Average Satisfaction Grade:
                            @for($i=0; $i < $user->averageRating(); ++$i)
                                <img src="/star.png" style="width:24px;height:24px;">
                            @endfor
                        </li>
                        <li>Admin: {{$user->adminToStr()}}</li>
                        <li>Blocked: {{$user->blockedToStr()}}</li>
                        <br><br>
                    </div>
                    <div style="float: right;">
                        <a class="btn btn-success side-offset" href="{{route('users.editProfile')}}">Edit Profile</a>
                        <a class="btn btn-primary" href="{{route('requests.create')}}">Add Request</a>
                    </div>
                    @if (count($requests))
                        <input type="text" id="myInput" onkeyup="filter()" placeholder="Search any column...">
                        <table class="table table-striped sortable table-hover" id="myTable">
                            <thead>
                            <tr>
                                <th>Request Number</th>
                                <th>Description</th>
                                <th>Open Date</th>
                                <th>Status<span id="sorttable_sortfwdind">&nbsp;▾</span></th>
                                <th class="sorttable_nosort"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($i=0)
                            @foreach ($requests as $request)
                                <tr>
                                    @if(is_null($request->closed_date))
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->id}}</a></td>
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->description}}</a></td>
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->created_at}}</a></td>
                                        <td><a href="{{route('requests.edit', $request)}}">{{$request->statusToStr()}}</a></td>
                                    @else
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->id}}</a></td>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->description}}</a></td>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->created_at}}</a></td>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->statusToStr()}}</a></td>
                                    @endif
                                        @if($request->status == 2)
                                            @if($request->satisfaction_grade == '')
                                                @php($request->satisfaction_grade = 0)
                                            @endif
                                            <td><div id="star{{++$i}}" class="c-rating"></div></td>
                                        @elseif($request->status == 1)
                                            <td><form action="{{route('requests.destroy',$request)}}" method="post" class="inline">
                                                    {{method_field('DELETE')}}
                                                    {{ csrf_field() }}
                                                    <button type="submit" class="btn btn-xs btn-danger">Delete</button>
                                            </form></td>
                                        @else
                                            <td></td>
                                        @endif
                                </tr>
                                <script src="/js/rating.js"></script>
                                <script>
                                    var el = document.querySelector('#star{{$i}}');
                                    var currentRating={{$request->satisfaction_grade}}
                                    var maxRating= 5;
                                    var callback = function(rating) {
                                        switch(rating) {
                                            case 1:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 1])}}";
                                                break;
                                            case 2:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 2])}}";
                                                break;
                                            case 3:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 3])}}";
                                                break;
                                            case 4:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 4])}}";
                                                break;
                                            default:
                                                window.location="{{ route('requests.rating', [$request, 'rating' => 5])}}";
                                        }
                                    };
                                    var myRating = rating(el, currentRating, maxRating, callback);
                                </script>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <h3>You have no active requests</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
