@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Departments List</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                {{ $departments->links() }}
                                @if(isset($sort['search']))
                                    <a href="{{ route('departments.index') }}" class="btn btn-success"
                                       style="float:right;">Clear Search</a>
                                @endif
                            </div>
                            <div class="col-xs-6">
                                <form>
                                    <button type="submit" class="btn btn-default btn-search"><span
                                                class="glyphicon glyphicon-search search-icon"></span></button>
                                    <input type="text" name="search" class="myInput" placeholder="Search any column..."/>
                                </form>
                                <a class="btn btn-primary" href="{{ route('departments.create') }}" style="float: right;">Add
                                    department</a>
                            </div>
                            {{--<input type="hidden" name="field" value="{{$sort['field']}}"/>
                            <input type="hidden" name="order" value="{{$sort['order']}}"/>--}}
                        </div>
                        @if(count($departments))
                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                <tr>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="departments.id"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='departments.id') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Department
                                                    Id ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Department
                                                    Id ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Department
                                                    Id
                                                </button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="departments.name"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='departments.name') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">
                                                    Name ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">
                                                    Name ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">
                                                    Name
                                                </button>
                                            @endif
                                        </form>
                                    </th>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="departments.created_at"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='departments.created_at') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Created
                                                    Date ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Created
                                                    Date ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Created
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
                                            <input type="hidden" name="field" value="departments.updated_at"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='departments.updated_at') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Updated
                                                    Date ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Updated
                                                    Date ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Updated
                                                    Date
                                                </button>
                                            @endif
                                        </form>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>
                                            {{$department->id}}
                                        </td>
                                        <td>
                                            {{$department->name}}
                                        </td>
                                        <td>
                                            {{$department->created_at}}
                                        </td>
                                        <td>
                                            {{$department->updated_at}}
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-primary"
                                               href="{{route('department.edit', $department)}}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {{$departments->links()}}
                        @else
                            <h3>No departments found</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection