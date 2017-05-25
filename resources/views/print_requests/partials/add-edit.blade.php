{{csrf_field()}}

<div class="form-group">
    <label for="inputDescription">Description</label>
    <input
        type="text" class="form-control"
        name="description" id="inputDescription" 
        @if(Route::currentRouteName()=='requests.create')
            value="{{old('description')}}"
        @else(Route::currentRouteName()=='requests.edit')
            value="{{$request->description}}"
        @endif
    />
</div>

<div class="form-group">
<label for="inputDueDate">Due Date</label>
    <input
        type="date" class="form-control"
        name="due_date" id="inputDueDate"
        @if(Route::currentRouteName()=='requests.create')
            value="{{old('due_date')}}"
        @else(Route::currentRouteName()=='requests.edit')
            value="{{$request->due_date}}"
        @endif
    />
</div>

<div class="form-group">
    <label for="inputQuantity">Quantity</label>
    <input
        type="number" class="form-control"
        name="quantity" id="inputQuantity"
        placeholder="quantity" min="1" 
        @if(Route::currentRouteName()=='requests.create')
            value="{{old('quantity')}}"
        @else(Route::currentRouteName()=='requests.edit')
            value="{{$request->quantity}}"
        @endif
    />
</div>

<div class="form-group">
    <label for="inputColored">Colored</label>
    <select name="colored" id="inputColored" class="form-control"
        @if(Route::currentRouteName()=='requests.create')
            value="{{old('colored')}}"
        @elseif(Route::currentRouteName()=='requests.edit')
            value="{{$request->colored}}"
        @endif">
        <option disabled selected> -- select an option -- </option>
        <option value="0">Color</option>
        <option value="1">Black and White</option>
    </select>
</div>

<div class="form-group">
    <label for="inputStapled">Stapled</label>
    <select name="stapled" id="inputStapled" class="form-control"
        @if(Route::currentRouteName()=='requests.create')
            value="{{old('stapled')}}"
        @elseif(Route::currentRouteName()=='requests.edit')
            value="{{$request->stapled}}"
        @endif">
        <option disabled selected> -- select an option -- </option>
        <option value="0">With Staple</option>
        <option value="1">No Staple</option>
    </select>
</div>


<div class="form-group">
    <label for="inputPaperSize">Paper Size</label>
    <select name="paper_size" id="inputPaperSize" class="form-control"

    <option value="4">A4</option>
        <option value="3">A3</option>
    </select>
</div>

<div class="form-group">
    <label for="inputPaperType">Paper Type</label>
    <select name="paper_type" id="inputPaperType" class="form-control"
    @if(Route::currentRouteName()=='requests.create')
        value="{{old('paper_type')}}"
        @else(Route::currentRouteName()=='requests.edit')
        value="{{$request->paper_type}}"
        @endif">
        <option disabled selected> -- select an option -- </option>
        <option value="0">Draft</option>
        <option value="1">Normal</option>
        <option value="2">Photographic</option>
        
    </select>
</div>

<div class="form-group">
    <label for="inputFrontBack">Front and Back</label>
    <select name="front_back" id="inputFrontBack" class="form-control"
        @if(Route::currentRouteName()=='requests.create')
            value="{{old('front_back')}}"
        @else(Route::currentRouteName()=='requests.edit')
            value="{{$request->front_back}}"
        @endif">
        <option disabled selected> -- select an option -- </option>
        <option value="0">Single Page</option>
        <option value="1">Front and Back</option>        
    </select>
</div>

<div class="form-group">
    <label for="inputFile">File</label>
    <input style="padding:0;"
        type="file" class="form-control"
        name="file" id="inputFile" accept="image/*, application/pdf, application/msword,
        application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel,
        application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .csv"
        @if(Route::currentRouteName()=='requests.create')
            value="{{old('file')}}"
        @else(Route::currentRouteName()=='requests.edit')
            value="{{$request->file}}"
        @endif
    />
</div>