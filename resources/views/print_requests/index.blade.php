@extends('master')
@push('page_name') - Requests @endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Requests List</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                {{ $requests->links() }}
                                @if(isset($sort['search']))
                                    <a href="{{ route('requests.index') }}" class="btn btn-success"
                                       style="float:right;">Clear Search</a>
                                @endif
                            </div>
                            <div class="col-xs-6">
                                @if(count($requests) || isset($sort['search']))
                                <form>
                                    <button type="submit" class="btn btn-default btn-search"><span
                                                class="glyphicon glyphicon-search search-icon"></span></button>
                                    <input type="text" name="search" class="myInput" placeholder="Search any column..."/>
                                </form>
                                @endif
                                <a class="btn btn-primary" href="{{ route('requests.create') }}" style="float: right;">Add
                                    request</a>
                            </div>
                            {{--<input type="hidden" name="field" value="{{$sort['field']}}"/>
                            <input type="hidden" name="order" value="{{$sort['order']}}"/>--}}
                        </div>
                        @if(count($requests))
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
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="users.id"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='users.id') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Owner
                                                    ID ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Owner ID
                                                    ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Owner
                                                    ID
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
                                        Image
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->id}}</a></td>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->owner_id}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route('requests.details', $request)}}">{{$request->user->name}}</a>
                                        </td>
                                        <td><a href="{{route('requests.details', $request)}}">{{$request->date()}}</a>
                                        </td>
                                        <td>
                                            @if($request->hasImage())
                                                <a href="{{route('requests.details', $request)}}">
                                                    <img src="data:image/{{$request->fileExtension()}};base64,{{$request->image()}}"
                                                         style="width:50px;height:50px;" alt="Image failed to load">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('requests.details', $request)}}">{{$request->statusToStr()}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {{$requests->links()}}
                        @else
                            <h3>No requests found</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection