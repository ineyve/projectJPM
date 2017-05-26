{{csrf_field()}}

<div class="form-group">
    <label for="inputDescription">Description</label>
    <input type="text" class="form-control" name="description" id="inputDescription" placeholder="Description"
        @if(Route::currentRouteName()=='requests.edit')
            value="{{$request->description}}"
        @endif
    />
</div>

<div class="form-group">
<label for="inputDueDate">Due Date</label>
    <input type="date" class="form-control" name="due_date" id="inputDueDate" placeholder="Due Date"
        @if(Route::currentRouteName()=='requests.edit')
            value="{{$request->due_date}}"
        @endif
    />
</div>

<div class="form-group">
    <label for="inputQuantity">Quantity</label>
    <input type="number" class="form-control" name="Quantity" id="inputQuantity" placeholder="Quantity" min="1"
        @if(Route::currentRouteName()=='requests.edit')
        value="{{$request->quantity}}"
        @endif
    />
</div>

<div class="form-group">
    <label for="inputColored">Colored</label>
    <select name="colored" id="inputColored" class="form-control">
        <option value="1">Colored</option>
        <option value="0"
        @if(isset($request) && $request->colored == 0)
            selected="selected"
        @endif
        >Black and White</option>
    </select>
</div>

<div class="form-group">
    <label for="inputStapled">Stapled</label>
    <select name="stapled" id="inputStapled" class="form-control">
        <option value="1">With Staple</option>
        <option value="0"
        @if(isset($request) && $request->stapled == 0)
            selected="selected"
        @endif
        >No Staple</option>
    </select>
</div>


<div class="form-group">
    <label for="inputPaperSize">Paper Size</label>
    <select name="paper_size" id="inputPaperSize" class="form-control">
    <option value="4">A4</option>
    <option value="3"
    @if(isset($request) && $request->paper_size == 3)
        selected="selected"
    @endif
    >A3</option>
    </select>
</div>

<div class="form-group">
    <label for="inputPaperType">Paper Type</label>
    <select name="paper_type" id="inputPaperType" class="form-control">
        <option value="0">Draft</option>
        <option value="1"
        @if(isset($request) && $request->paper_type == 1)
            selected="selected"
        @endif
        >Normal</option>
        <option value="2"
        @if(isset($request) && $request->paper_type == 2)
            selected="selected"
        @endif
        >Photographic</option>
        
    </select>
</div>

<div class="form-group">
    <label for="inputFrontBack">Front and Back</label>
    <select name="front_back" id="inputFrontBack" class="form-control">
        <option value="0">Single Page</option>
        <option value="1"
        @if(isset($request) && $request->front_back == 1)
            selected="selected"
        @endif
        >Front and Back</option>
    </select>
</div>

<div class="form-group">
    <label for="inputFile">File</label>
    <input
        type="file" class="form-control" name="file" id="inputFile" accept="image/*, application/pdf,
        application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document,
        application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, .csv"/>
</div>