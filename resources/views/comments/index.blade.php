@extends('master')
@push('page_name') - Comments @endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Blocked Comments</div>
                    <div class="panel-body">
                        {{ $comments->links() }}
                        @if (count($comments))
                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Request</th>
                                    <th>Owner</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td><a href="{{route('requests.details', $comment->request_id)}}">{{$comment->id}}</a></td>
                                        <td><a href="{{route('requests.details', $comment->request_id)}}">{{$comment->request_id}}</a></td>
                                        <td><a href="{{route('requests.details', $comment->request_id)}}">{{$comment->user->name}}</a></td>
                                        <td><a href="{{route('requests.details', $comment->request_id)}}">{{$comment->comment}}</a></td>
                                        <td><a href="{{route('requests.details', $comment->request_id)}}">
                                                <a class="btn btn-xs btn-success"
                                                   href="{{ route('comment.block', ['comment' => $comment, 'block' => 0]) }}">Unblock</a>
                                            </a></td>
                                    </tr>
                                @endforeach
                            </table>
                            {{ $comments->links() }}
                        @else
                            <h3>No blocked comments found</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection