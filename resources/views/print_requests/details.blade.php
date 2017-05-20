@extends('master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Request {{$request->id}}</div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Property</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Description</td>
                                <td>{{$request->description}}</td>
                            </tr>
                        
                            <tr>
                                <td>Owner Name</td>
                                <td>{{$request->user->name}}</td>
                            </tr>

                            <tr>
                                <td>Owner Department</td>
                                <td>{{$request->user->department->name}}</td>
                            </tr>

                            <tr>
                                <td>Owner Email</td>
                                <td>{{$request->user->email}}</td>
                            </tr>

                            <tr>
                                <td>Owner Phone</td>
                                <td>{{$request->user->phone}}</td>
                            </tr>

                            <tr>
                                <td>Open Date</td>
                                <td>{{$request->created_at}}</td>
                            </tr>

                            <tr>
                                <td>Quantity</td>
                                <td>{{$request->quantity}}</td>
                            </tr>

                            <tr>
                                <td>Colored</td>
                                <td>{{$request->coloredToStr()}}</td>
                            </tr>

                            <tr>
                                <td>Stapled</td>
                                <td>{{$request->stapledToStr()}}</td>
                            </tr>
                            
                            <tr>
                                <td>Paper Size</td>
                                <td>A{{$request->paper_size}}</td>
                            </tr>
                            
                            <tr>
                                <td>Paper Type</td>
                                <td>{{$request->typeToStr()}}</td>
                            </tr>

                            <tr>
                                <td>Front Back</td>
                                <td>{{$request->frontBackToStr()}}</td>
                            </tr>
                            
                            <tr>
                                <td>File</td>
                                <td><a class="btn btn-xs btn-success" href="{{route('requests.download', $request)}}">Download</a></td>
                            </tr>
                            
                            <tr>
                                <td>Status</td>
                                <td>{{$request->statusToStr()}}</td>
                            </tr>

                            @if($request->due_date != null)
                                <tr>
                                    <td>Due Date</td>
                                    <td>{{$request->due_date}}</td>
                                </tr>
                            @endif

                            @if($request->printer_id != null)
                                <tr>
                                    <td>Printer ID</td>
                                    <td>{{$request->printer_id}}</td>
                                </tr>
                            @endif

                            @if($request->closed_date != null)
                                <tr>
                                    <td>Closed Date</td>
                                    <td>{{$request->closed_date}}</td>
                                </tr>
                            @endif

                            @if($request->closed_user_id != null)
                                <tr>
                                    <td>Closed By User</td>
                                    <td>{{$request->closed_user_id}}</td>
                                </tr>
                            @endif

                            @if($request->refused_reason != null)
                                <tr>
                                    <td>Refused Reason</td>
                                    <td>{{$request->refused_reason}}</td>
                                </tr>
                            @endif
                            <tr>
                                <td>Satisfaction Grade</td>
                                <td>
                                @if($request->status == 2 && $user == $request->owner_id)
                                    @if(is_null($request->satisfaction_grade))
                                        @php($request->satisfaction_grade = 0)
                                    @endif
                                    <center><div id="star" class="c-rating" style="width: 100px;"></div></center>
                                @else
                                    @for($i=0; $i < $request->satisfaction_grade; $i++)
                                        <img src="/star.png" style="width:24px;height:24px;">
                                    @endfor
                                @endif
                                </td>
                            </tr>
                            <script src="/js/rating.js"></script>
                            <script>
                                var el = document.querySelector('#star');
                                @if(isset($request->satisfaction_grade))
                                    var currentRating={{$request->satisfaction_grade}};
                                @else
                                    var currentRating=0;
                                @endif
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

                            <tr>
                                <td>Created</td>
                                <td>{{$request->created_at}}</td>
                            </tr>

                            <tr>
                                <td>Last Update</td>
                                <td>{{$request->updated_at}}</td>
                            </tr>
                        </tbody>
                    </table>
                    
                    @can('admin')
                    @if($request->status == 0)
                        <a class="btn btn-success side-offset" href='javascript:showComplete()' id="buttonComplete">Complete</a>
                        <form action="{{route('requests.complete', $request)}}" method="post" class="form-group" id="complete-form" style="display:none">
                        {{ csrf_field() }}
                            <div class="form-group" id="complete">
                                <label for="inputComplete">Complete</label>
                                <select name="printer_id" id="inputComplete" class="form-control">
                                    <option disabled selected> -- select an option -- </option>
                                    @foreach($printers as $printer)
                                       <option value="{{$printer->id}}">{{$printer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="submitComplete">
                                <button type="submit" class="btn btn-success side-offset">Complete</button>
                                <a class="btn btn-default" href='javascript:hideComplete()' id="cancelComplete">Cancel</a>
                            </div>
                        </form>
    
                        <a class="btn btn-danger side-offset" href='javascript:showRefuse()' id="buttonRefuse">Refuse</a>
                        <form action="{{route('requests.refuse', $request)}}" method="post" class="form-group" id="refuse-form" style="display:none">
                            {{ csrf_field() }}
                            <div class="form-group" id="refuse">
                                <label for="inputReason">Refuse Reason</label>
                                <textarea class="form-control" name="refused_reason" id="inputReason"></textarea>
                            </div>
                            <div class="form-group" id="submitRefuse">
                                <button type="submit" class="btn btn-danger side-offset">Refuse</button>
                                <a class="btn btn-default" href='javascript:hideRefuse()' id="cancelRefuse">Cancel</a>
                            </div>
                        </form>
                    @endif
                    @endcan
                    @php($count=0)
                    @foreach($comments as $comment)
                        @if($comment->parent_id == '' && !$comment->blocked)
                            @php(++$count)
                            <div class="comment">
                                <a href="{{ route('users.profile', $comment->user_id) }}"><img class="comment-picture" src="/profile.jpg"></a>

                                <p class="first"><a href="{{route('users.profile', $comment->user_id)}}">{{$comment->user->name}}</a> &nbsp&nbsp&nbsp&nbsp{{$comment->created_at}}</p>
                                <p>{{$comment->comment}}</p>

                                <a class="btn btn-xs btn-primary" href='javascript:showReply()' id="buttonReply">Reply</a>

                                <form action="{{route('requests.reply', ['request' => $request, 'comment' => $comment])}}" method="post" class="form-group" id="reply-form" style="display:none;">
                                    {{ csrf_field() }}
                                    <div class="form-group" id="reply" style="margin-left: 10px; margin-right: 10px;">
                                        <label for="inputReply">Reply</label>
                                        <textarea class="form-control" name="reply" id="inputReply"></textarea>
                                    </div>
                                    <div class="form-group" id="submitReply">
                                        <button type="submit" class="btn btn-xs btn-primary side-offset">Reply</button>
                                        <a class="btn btn-xs btn-default" href='javascript:hideReply()' id="cancelReply">Cancel</a>
                                    </div>
                                </form>
                            @foreach($comments as $reply)
                                @if($reply->parent_id == $comment->id && !$reply->blocked)
                                        <div class="reply">
                                            <a href="{{ route('users.profile', $reply->user_id) }}"><img class="comment-picture" src="/profile.jpg"></a>
                                            <p class="first"><a href="{{route('users.profile', $reply->user_id)}}">{{$reply->user->name}}</a> &nbsp&nbsp&nbsp&nbsp{{$reply->created_at}}</p>
                                            <p>{{$reply->comment}}</p>
                                        </div>
                                @endif
                            @endforeach
                            </div>
                        @endif
                    @endforeach
                    @if($admin && $count)
                        <br>
                    @endif
                    <a class="btn btn-primary" href='javascript:showComment()' id="buttonComment">Comment</a>
                    <form action="{{route('requests.comment', $request)}}" method="post" class="form-group" id="comment-form" style="display:none">
                        {{ csrf_field() }}
                        <div class="form-group" id="comment">
                            <label for="inputComment">Comment</label>
                            <textarea class="form-control" name="comment" id="inputComment"></textarea>
                        </div>
                        <div class="form-group" id="submitComment">
                            <button type="submit" class="btn btn-primary side-offset">Comment</button>
                            <a class="btn btn-default" href='javascript:hideComment()' id="cancelComment">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>function showRefuse(){
        $('#refuse-form').show();
        $('#buttonRefuse').hide();
        $('#buttonComplete').hide();
        $('#buttonComment').hide();
    }
</script>
<script>function hideRefuse(){
        $('#refuse-form').hide();
        $('#buttonRefuse').show();
        $('#buttonComplete').show();
        $('#buttonComment').show();
    }
</script>
<script>function showComment(){
        $('#comment-form').show();
        $('#buttonComment').hide();
        $('#buttonRefuse').hide();
        $('#buttonComplete').hide();
    }
</script>
<script>function hideComment(){
        $('#comment-form').hide();
        $('#buttonComment').show();
        $('#buttonRefuse').show();
        $('#buttonComplete').show();
    }
</script>
<script>function showReply(){
        $('#reply-form').show();
        $('#buttonReply').hide();
    }
</script>
<script>function hideReply(){
        $('#reply-form').hide();
        $('#buttonReply').show();
    }
</script>
<script>function hideComplete(){
        $('#complete-form').hide();
        $('#buttonComplete').show();
        $('#buttonComment').show();
        $('#buttonRefuse').show();
    }
</script>
<script>function showComplete(){
        $('#complete-form').show();
        $('#buttonComplete').hide();
        $('#buttonComment').hide();
        $('#buttonRefuse').hide();
    }
</script>

