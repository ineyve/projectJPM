{{csrf_field()}}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="inputName" class="control-label">Department's name</label>
    <input type="text" class="form-control" name="name" id="inputName" placeholder="Name"
           @if(Route::currentRouteName()=='departments.edit')
                value="{{$department->name}}"
           @endif
    >
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>