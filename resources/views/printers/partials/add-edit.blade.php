{{csrf_field()}}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label for="inputName" class="control-label">Printers's name</label>
    <input type="text" class="form-control" name="name" id="inputName" placeholder="Name"
           @if(Route::currentRouteName()=='printers.edit')
                value="{{$printer->name}}"
           @endif
    >
    @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>