@extends('master')
@push('page_name') - Printers @endpush
@section('content')
    <form action="{{route('printers.update', $printer)}}" method="post" class="form-group">
        {{method_field('PUT')}}
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Edit Department</div>
                        <div class="panel-body">
                            @include('printers.partials.add-edit')
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary side-offset" name="ok">Save</button>
                                <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
