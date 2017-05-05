{{csrf_field()}}

<div class="form-group">
    <label for="inputDescription">Description</label>
    <input
        type="text" class="form-control"
        name="description" id="inputDescription"
        placeholder="description"
        @if(Route::currentRouteName()=='requests.store')
        value="{{old('description', $request->description)}}"
        @elsif(Route::currentRouteName()=='requests.edit')
        value="{{$request->description}}"
        @else
        value=""
        @endif
    />
</div>

<div class="form-group">
<label for="inputRequestDate">Request Date</label>
    <input
        type="date" class="form-control"
        name="request_date" id="inputRequestDate" 
        @if(Route::currentRouteName()=='requests.store')
        value="{{old('request_date', $request->request_date)}}"
        @elsif(Route::currentRouteName()=='requests.edit')
        value="{{$request->request_date}}"
        @else
        value=""
        @endif
    />
</div>

<div class="form-group">
<label for="inputDueDate">Due Date</label>
    <input
        type="date" class="form-control"
        name="due_date" id="inputDueDate"
        @if(Route::currentRouteName()=='requests.store')
        value="{{old('due_date', $request->due_date)}}"
        @elsif(Route::currentRouteName()=='requests.edit')
        value="{{$request->due_date}}"
        @else
        value=""
        @endif
    />
</div>

<div class="form-group">
    <label for="inputQuantity">Quantity</label>
    <input
        type="number" class="form-control"
        name="quantity" id="inputQuantity"
        placeholder="quantity"
        @if(Route::currentRouteName()=='requests.store')
        value="{{old('quantity', $request->quantity)}}"
        @elsif(Route::currentRouteName()=='requests.edit')
        value="{{$request->quantity}}"
        @else
        value=""
        @endif
    />
</div>
    
<div class="form-group">
    <label for="inputColored">Colored</label>
    <select name="colored" id="inputColored" class="form-control "
    @if(Route::currentRouteName()=='requests.store')
        value="{{old('quantity', $request->quantity)}}"
        @elsif(Route::currentRouteName()=='requests.edit')
        value="{{$request->quantity}}"
        @else
        value=""
        @endif">
        <option disabled selected> -- select an option -- </option>
        <option value="0">Color</option>
        <option value="1">Black and White</option>
    </select>
</div>

<div class="form-group">
    <label for="inputStapled">Stapled</label>
    <select name="stapled" id="inputStapled" class="form-control "
    @if(Route::currentRouteName()=='requests.store')
        value="{{old('stapled', $request->stapled)}}"
        @elsif(Route::currentRouteName()=='requests.edit')
        value="{{$request->stapled}}"
        @else
        value=""
        @endif">
        <option disabled selected> -- select an option -- </option>
        <option value="0">With Staple</option>
        <option value="1">No Staple</option>
    </select>
</div>

<div class="form-group">
    <label for="inputPaperSize">Paper Size</label>
    <select name="paper_size" id="inputPaperSize" class="form-control "
    @if(Route::currentRouteName()=='requests.store')
        value="{{old('paper_size', $request->paper_size)}}"
        @elsif(Route::currentRouteName()=='requests.edit')
        value="{{$request->paper_size}}"
        @else
        value=""
        @endif">
        <option disabled selected> -- select an option -- </option>
        <option value="0">A4</option>
        <option value="1">A3</option>
    </select>
</div>

<div class="form-group">
    <label for="inputPaperType">Paper Type</label>
    <select name="paper_type" id="inputPaperType" class="form-control "
    @if(Route::currentRouteName()=='requests.store')
        value="{{old('paper_type', $request->paper_type)}}"
        @elsif(Route::currentRouteName()=='requests.edit')
        value="{{$request->paper_type}}"
        @else
        value=""
        @endif">
        <option disabled selected> -- select an option -- </option>
        <option value="0">Draft</option>
        <option value="1">Normal</option>
        <option value="1">Photographic</option>
    </select>
</div>

<div class="form-group">
    <label for="inputFile">File</label>
    <input
        type="file" class="form-control"
        name="file" id="inputFile" accept="image/png"
        @if(Route::currentRouteName()=='requests.store')
        value="{{old('file', $request->file)}}"
        @elsif(Route::currentRouteName()=='requests.edit')
        value="{{$request->file}}"
        @else
        value=""
        @endif
    />
</div>


