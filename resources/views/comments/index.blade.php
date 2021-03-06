@extends('master')
@push('page_name') - Comments @endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Blocked Comments</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                {{ $comments->links() }}
                                @if(isset($sort['search']))
                                    <a href="{{ route('comments.index') }}" class="btn btn-success"
                                       style="float:right;">Clear Search</a>
                                @endif
                            </div>
                            @if(count($comments) || isset($sort['search']))
                                <div class="col-xs-6">
                                    <form>
                                        <button type="submit" class="btn btn-default btn-search"><span
                                                    class="glyphicon glyphicon-search search-icon"></span></button>
                                        <input type="text" name="search" class="myInput v2" placeholder="Search any column..."/>
                                    </form>
                                </div>
                            @endif
                        </div>
                        @if (count($comments))
                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                <tr>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="comments.id"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='comments.id') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">ID ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">ID ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">ID
                                                </button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="comments.request_id"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='comments.request_id') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Request ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Request ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Request
                                                </button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="users.name"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='users.name') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Owner ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Owner ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Owner
                                                </button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="comments.comment"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='comments.comment') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Comment ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Comment ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Comment
                                                </button>
                                            @endif
                                        </form>
                                    </th>
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
                                        <td><a class="btn btn-xs btn-success"
                                                   href="{{ route('comment.block', ['comment' => $comment, 'block' => 0]) }}">Unblock</a>
                                        </td>
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