{{csrf_field()}}
@push('master_header')
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script type="text/javascript">
    $(window).load(function () {
        $.getScript("//code.jquery.com/jquery-1.10.2.js", function () {
            $.getScript("//code.jquery.com/ui/1.11.2/jquery-ui.js", function () {
                $(function () {
                    $("#inputDueDate").datepicker({
                        changeMonth: true,
                        changeYear: true
                    });
                });
            });
        });
    });
</script>

@endpush
<div class="form-group">
    <label for="inputDueDate">Due Date</label>
    <input type="date" data-date-inline-picker="true" class="form-control" name="due_date" id="inputDueDate"
           @if(old('due_date') != null)
           value="{{old('due_date')}}"
           @elseif(Route::currentRouteName()=='requests.edit')
           value="{{$request->due_date}}"
           @endif
           autofocus>
</div>
<div class="form-group{{ $errors->has('quantity') ? ' has-error' : '' }}">
    <label for="inputQuantity" class="control-label">Quantity</label>
    <input type="number" class="form-control" name="quantity" id="inputQuantity" placeholder="Quantity" min="1"
           @if(old('quantity') != null)
           value="{{old('quantity')}}"
           @elseif(Route::currentRouteName()=='requests.edit')
           value="{{$request->quantity}}"
            @endif
    >
    @if ($errors->has('quantity'))
        <span class="help-block">
            <strong>{{ $errors->first('quantity') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <label for="inputColored">Colored</label>
    <select name="colored" id="inputColored" class="form-control">
        <option value="1">Colored</option>
        <option value="0"
                @if(isset($request) && $request->colored == 0 || old('colored') == 0)
                selected="selected"
                @endif
        >Black and White
        </option>
    </select>
</div>
<div class="form-group">
    <label for="inputStapled">Stapled</label>
    <select name="stapled" id="inputStapled" class="form-control">
        <option value="1">With Staple</option>
        <option value="0"
                @if(isset($request) && $request->stapled == 0 || old('stapled') == 0)
                selected="selected"
                @endif
        >No Staple
        </option>
    </select>
</div>
<div class="form-group">
    <label for="inputPaperSize">Paper Size</label>
    <select name="paper_size" id="inputPaperSize" class="form-control">
        <option value="4">A4</option>
        <option value="3"
                @if(isset($request) && $request->paper_size == 3 || old('paper_size') == 3)
                selected="selected"
                @endif
        >A3
        </option>
    </select>
</div>
<div class="form-group">
    <label for="inputPaperType">Paper Type</label>
    <select name="paper_type" id="inputPaperType" class="form-control">
        <option value="0">Draft</option>
        <option value="1"
                @if(isset($request) && $request->paper_type == 1 || old('paper_type') == 1)
                selected="selected"
                @endif
        >Normal
        </option>
        <option value="2"
                @if(isset($request) && $request->paper_type == 2 || old('paper_type') == 2)
                selected="selected"
                @endif
        >Photographic
        </option>

    </select>
</div>
<div class="form-group">
    <label for="inputFrontBack">Front and Back</label>
    <select name="front_back" id="inputFrontBack" class="form-control">
        <option value="0">Single Page</option>
        <option value="1"
                @if(isset($request) && $request->front_back == 1 || old('front_back') == 1)
                selected="selected"
                @endif
        >Front and Back
        </option>
    </select>
</div>
<div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
    <label for="inputFile" class="control-label">File</label>
    <input
            type="file" class="form-control" name="file" id="inputFile" accept="image/*, application/pdf,
        application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document,
        application/excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .csv"
            @if(Route::currentRouteName()=='requests.create')
            required
            @endif
    >
    @if ($errors->has('file'))
        <span class="help-block">
            <strong>{{ $errors->first('file') }}</strong>
        </span>
    @endif
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    <label for="inputDescription" class="control-label">Description</label>
    <textarea type="text" class="form-control" name="description" id="inputDescription" placeholder="Description"
              required>
@if(old('description') != null)
            {{old('description')}}
        @elseif(Route::currentRouteName()=='requests.edit')
            {{$request->description}}
        @endif
</textarea>
    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>