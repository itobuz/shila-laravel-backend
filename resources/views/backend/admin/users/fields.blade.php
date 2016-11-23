<div class="form-group">
    {!!Form::label('name','Name')!!}
    {!!Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Full Name'])!!}

</div>
<div class="form-group">
    {!!Form::label('email','Email')!!}
    {!!Form::email('email',null,['class'=>'form-control','id'=>'display_name','placeholder'=>'Email Address'])!!}

</div>
<div class="form-group">
    {!!Form::label('password','Password')!!}
    {!!Form::password('password',['class'=>'form-control','placeholder'=>'Password'])!!}
    <input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Show password

</div>
<div class="form-group">
    {!!Form::label('roles','Roles')!!}
    {!!Form::select('roles', $roles,$attached, array('class' => 'form-control', 'data-placeholder'=>'Select a role'))!!}

</div>
<div class="form-group">
    {!!Form::label('status','Status')!!}
    {!!Form::select('status', ['1'=>'Active','0'=>'Inactive'],null, array('class' => 'form-control'))!!}

</div>