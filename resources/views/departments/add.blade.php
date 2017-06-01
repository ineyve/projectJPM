@extends('master')
@push('page_name') - Departments @endpush
@section('content')

    <form action="{{route('departments.store')}}" method="post" class="form-group" enctype="multipart/form-data">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Department</div>
                        <div class="panel-body">

                            @include('departments.partials.add-edit')
                            teste
                            {{var_dump($department)}}
                            <<<
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary side-offset" name="ok">Add</button>
                                <a class="btn btn-default" href="{{route('departments.index')}}">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection