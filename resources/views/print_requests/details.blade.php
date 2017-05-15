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
                                <td>{{$request->open_date}}</td>
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

                            @if($request->satisfaction_grade != null)
                                <tr>
                                    <td>Satisfaction Grade</td>
                                    <td>
                                        @for($i=0; $i < $request->satisfaction_grade; $i++)
                                            <img src="/star.png" style="width:24px;height:24px;">
                                        @endfor
                                    </td>
                                </tr>
                            @endif

                            @if($request->created_at != null)
                                <tr>
                                    <td>Created</td>
                                    <td>{{$request->created_at}}</td>
                                </tr>
                            @endif

                            @if($request->updated_at != null)
                                <tr>
                                    <td>Last Update</td>
                                    <td>{{$request->updated_at}}</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    
                    @if($admin)
                        @if($request->status == 0 && is_null($request->closed_date))
                            <a class="btn btn-success side-offset" href="{{route('requests.complete', ['request' => $request, 'from' => 0])}}" id="buttonAccept">Complete</a>
                            <a class="btn btn-danger" href='javascript:showRefuse()' id="buttonRefuse">Refuse</a>
                            <form action="{{route('requests.refuse', $request)}}" method="post" class="form-group">
                                {{ csrf_field() }}
                                <div class="form-group" id="refuse" style="display:none">
                                    <label for="inputReason">Refuse Reason</label>
                                    <textarea class="form-control" name="refused_reason" id="inputReason"></textarea>
                                </div>
                                <div class="form-group" id="submitRefuse" style="display:none;">
                                    <button type="submit" class="btn btn-danger side-offset">Refuse</button>
                                    <a class="btn btn-default" href='javascript:hideRefuse()' id="cancelRefuse">Cancel</a>
                                </div>
                            </form>
                        @endif
                    @endif
                    @foreach($comments as $comment)
                        @if($comment->parent_id == '')
                            <div class="comment">
                                <a href="{{ route('users.profile', $comment->user_id) }}"><img class="comment-picture" src="/profile.jpg"></a>
                                <p class="first"><a href="{{route('users.profile', $comment->user_id)}}">{{$comment->user->name}}</a> &nbsp&nbsp&nbsp&nbsp{{$comment->created_at}}</p>
                                <p>{{$comment->comment}}</p>
                                <a class="btn btn-xs btn-primary" href='javascript:showReply()' id="buttonReply">Reply</a>
                                <form action="{{route('requests.reply', ['request' => $request, 'comment' => $comment])}}" method="post" class="form-group">
                                    {{ csrf_field() }}
                                    <div class="form-group" id="reply" style="display:none; margin-left: 10px; margin-right: 10px;">
                                        <label for="inputReply">Reply</label>
                                        <textarea class="form-control" name="reply" id="inputReply"></textarea>
                                    </div>
                                    <div class="form-group" id="submitReply" style="display:none">
                                        <button type="submit" class="btn btn-xs btn-primary side-offset">Reply</button>
                                        <a class="btn btn-xs btn-default" href='javascript:hideReply()' id="cancelReply">Cancel</a>
                                    </div>
                                </form>
                            @foreach($comments as $reply)
                                @if($reply->parent_id == $comment->id)
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
                    @if($request->status == 0 && !is_null($request->closed_date))
                        <br>
                        <a class="btn btn-primary" href='javascript:showComment()' id="buttonComment">Comment</a>
                        <form action="{{route('requests.comment', $request)}}" method="post" class="form-group">
                            {{ csrf_field() }}
                            <div class="form-group" id="comment" style="display:none">
                                <label for="inputComment">Comment</label>
                                <textarea class="form-control" name="comment" id="inputComment"></textarea>
                            </div>
                            <div class="form-group" id="submitComment" style="display:none">
                                <button type="submit" class="btn btn-primary side-offset">Comment</button>
                                <a class="btn btn-default" href='javascript:hideComment()' id="cancelComment">Cancel</a>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>function showRefuse(){
        $('#refuse').show();
        $('#submitRefuse').show();
        $('#cancelRefuse').show();
        $('#buttonRefuse').hide();
        $('#buttonAccept').hide();
    }
</script>
<script>function hideRefuse(){
        $('#refuse').hide();
        $('#submitRefuse').hide();
        $('#cancelRefuse').hide();
        $('#buttonRefuse').show();
        $('#buttonAccept').show();
    }
</script>
<script>function showComment(){
        $('#comment').show();
        $('#submitComment').show();
        $('#cancelComment').show();
        $('#buttonComment').hide();
    }
</script>
<script>function hideComment(){
        $('#comment').hide();
        $('#submitComment').hide();
        $('#cancelComment').hide();
        $('#buttonComment').show();
    }
</script>
<script>function showReply(){
        $('#reply').show();
        $('#submitReply').show();
        $('#cancelReply').show();
        $('#buttonReply').hide();
    }
</script>
<script>function hideReply(){
        $('#reply').hide();
        $('#submitReply').hide();
        $('#cancelReply').hide();
        $('#buttonReply').show();
    }
</script>