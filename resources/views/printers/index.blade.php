@extends('master')
@push('page_name') - Printers @endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Printers List</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-6">
                                {{ $printers->links() }}
                                @if(isset($sort['search']))
                                    <a href="{{ route('printers.index') }}" class="btn btn-success"
                                       style="float:right;">Clear Search</a>
                                @endif
                            </div>
                            <div class="col-xs-6">
                                <form>
                                    <button type="submit" class="btn btn-default btn-search"><span
                                                class="glyphicon glyphicon-search search-icon"></span></button>
                                    <input type="text" name="search" class="myInput" placeholder="Search any column..."/>
                                </form>
                                <a class="btn btn-primary" href="{{ route('printers.create') }}" style="float: right;">Add
                                    printer</a>
                            </div>
                            {{--<input type="hidden" name="field" value="{{$sort['field']}}"/>
                            <input type="hidden" name="order" value="{{$sort['order']}}"/>--}}
                        </div>
                        @if(count($printers))
                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                <tr>
                                    <th>
                                        <form>
                                            @if(isset($sort['search']))
                                                <input type="hidden" name="search" value="{{$sort['search']}}"/>
                                            @endif
                                            <input type="hidden" name="field" value="printers.id"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='printers.id') <!-- table column name -->
                                            @if($sort['order']=='ASC')
                                                <button type="submit" name="order" value="DESC" class="btn-link">Printer
                                                    Id ▾
                                                </button>
                                            @elseif($sort['order']=='DESC')
                                                <button type="submit" name="order" value="ASC" class="btn-link">Printer
                                                    Id ▴
                                                </button>
                                            @endif
                                            @else
                                                <button type="submit" name="order" value="ASC" class="btn-link">Printer
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
                                            <input type="hidden" name="field" value="printers.name"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='printers.name') <!-- table column name -->
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
                                            <input type="hidden" name="field" value="printers.created_at"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='printers.created_at') <!-- table column name -->
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
                                            <input type="hidden" name="field" value="printers.updated_at"/>
                                            <!-- table column name -->
                                            @if($sort['field']=='printers.updated_at') <!-- table column name -->
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
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($printers as $printer)
                                    <tr>
                                        <td>
                                            {{$printer->id}}
                                        </td>
                                        <td>
                                            {{$printer->name}}
                                        </td>
                                        <td>
                                            {{$printer->created_at}}
                                        </td>
                                        <td>
                                            {{$printer->updated_at}}
                                        </td>
                                        <td>
                                            <a class="btn btn-xs btn-primary"
                                               href="{{route('printers.edit', $printer)}}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            {{$printers->links()}}
                        @else
                            <h3>No printers found</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection