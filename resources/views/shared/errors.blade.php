
<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <ul>
    @foreach ($errors as $error) 
        <li>{{$error}}</li>
    @endforeach
    </ul>
</div>

