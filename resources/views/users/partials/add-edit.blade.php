{{ csrf_field() }}

<div class="form-group">
    <label for="inputName">Name</label>
    <input
        type="text" class="form-control"
        name="name" id="inputName"
        placeholder="Name" value="{{old('name', $user->name)}}" />
</div>
<div class="form-group">
    <label for="inputEmail">Email</label>
    <input
        type="email" class="form-control"
        name="email" id="inputEmail"
        placeholder="Email address" value="{{old('email', $user->email)}}"/>
</div>
<div class="form-group">
    <label for="inputPhone">Phone</label>
    <input
        type="tel" class="form-control"
        name="phone" id="inputPhone"
        placeholder="Phone" value="{{old('phone', $user->phone)}}" />
</div>
<div class="form-group">
    <label for="inputPassword">Password</label>
    <input
        type="password" class="form-control"
        name="password" id="inputPassword"
        placeholder="Password"/>
</div>
<div class="form-group">
    <label for="inputPasswordConfirmation">Password Confirmation</label>
    <input
        type="password" class="form-control"
        name="PasswordConfirmation" id="inputPasswordConfirmation"
        placeholder="Password Confirmation"/>
</div>
<div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
    <label for="department_id" class="col-md-4 control-label">Department</label>
        <select name="department_id" id="inputDepartment" class="form-control">
            <option disabled selected> -- select an option -- </option>
            @foreach($departments as $department)
                <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach
        </select>
</div>
