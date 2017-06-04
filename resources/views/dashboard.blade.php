@extends('master')
@push('page_name') - Dashboard @endpush
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
                        Dashboard (User {{$user->id}})
                    </div>
                    <div class="panel-body">
                        <div class="profile" id="profile-user">
                            @include('users.partials.profileInfo')
                        </div>
                        <br>
                        <div style="float:left;">{{ $requests->links() }}</div>
                        @if (count($requests) || isset($sort['search']))
                            <div class="col-xs-6">
                                <form>
                                    <button type="submit" class="btn btn-default btn-search"><span
                                                class="glyphicon glyphicon-search search-icon"></span></button>
                                    <input type="text" name="search" class="myInput v2" placeholder="Search any column..."/>
                                </form>
                            </div>
                        @endif
                        <div style="float: right;">
                            <a class="btn btn-success side-offset" href="{{route('users.editProfile')}}">Edit
                                Profile</a>
                            <a class="btn btn-primary" href="{{route('requests.create')}}">Add Request</a>
                        </div>
                        @if (count($requests))
                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                <tr>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="requests.id"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='requests.id') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Request
                                                    Number ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Request
                                                    Number ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Request
                                                    Number
                                                </button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        @if(isset($sort['search']))
                                            <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                        @endif
                                        <input type="hidden" name="field" value="requests.description"/>
                                        <!-- table column name -->
                                        @if($sort['field']=='requests.description') <!-- table column name -->
                                        @if($sort['order']=='ASC')
                                            <button type="submit" name="order" value="DESC" class="btn-link">Description
                                                ▾
                                            </button>
                                        @elseif($sort['order']=='DESC')
                                            <button type="submit" name="order" value="ASC" class="btn-link">Description
                                                ▴
                                            </button>
                                        @endif
                                        @else
                                            <button type="submit" name="order" value="ASC" class="btn-link">
                                                Description
                                            </button>
                                        @endif
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="due_date"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='due_date') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Due
                                                    Date ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Due Date
                                                    ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Due
                                                    Date
                                                </button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="requests.status"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='requests.status') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Status
                                                    ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Status
                                                    ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Status
                                                </button>
                                            @endif
                                        </form>
                                    </th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($i=0)
                                @foreach ($requests as $request)
                                    <tr>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->id}}</a></td>
                                        <td>
                                            <a href="{{route('requests.details', $request)}}">{{$request->description}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route('requests.details', $request)}}">{{$request->date()}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route('requests.details', $request)}}">{{$request->statusToStr()}}</a>
                                        </td>
                                        <td>
                                            @if($request->status == 2)
                                                @if(is_null($request->satisfaction_grade))
                                                    @php($request->satisfaction_grade = 0)
                                                @endif
                                                <div id="star{{++$i}}" class="c-rating"></div>
                                            @elseif($request->status == 0)
                                                <a class="btn btn-xs btn-primary"
                                                   href="{{route('requests.edit', $request)}}">Edit</a>
                                                <form action="{{route('requests.destroy',$request)}}" method="post"
                                                      class="inline">
                                                    {{method_field('DELETE')}}
                                                    {{ csrf_field() }}
                                                    <button type="submit"
                                                            onclick="return confirm('Are you sure you want to cancel this request?')"
                                                            class="btn btn-xs btn-danger">Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                    <script src="/js/rating.js"></script>
                                    <script>
                                        var el = document.querySelector('#star{{$i}}');
                                                @if(isset($request->satisfaction_grade))
                                        var currentRating ={{$request->satisfaction_grade}};
                                                @else
                                        var currentRating = 0;
                                                @endif
                                        var maxRating = 3;
                                        var callback = function (rating) {
                                            switch (rating) {
                                                case 1:
                                                    window.location = "{{ route('requests.rating', [$request, 'rating' => 1])}}";
                                                    break;
                                                case 2:
                                                    window.location = "{{ route('requests.rating', [$request, 'rating' => 2])}}";
                                                    break;
                                                case 3:
                                                    window.location = "{{ route('requests.rating', [$request, 'rating' => 3])}}";
                                                    break;
                                            }
                                        };
                                        var myRating = rating(el, currentRating, maxRating, callback);
                                    </script>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <br><br><h3>You have no active requests</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
