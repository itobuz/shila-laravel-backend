<div class="form-group">
    {!!Form::label('name','Name')!!}
    {!!Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Permission Name'])!!}

</div>
<div class="form-group">
    {!!Form::label('display_name','Display Name')!!}
    {!!Form::text('display_name',null,['class'=>'form-control','id'=>'display_name','placeholder'=>'Display Name'])!!}

</div>
<div class="form-group">
    {!!Form::label('description','Description')!!}
    {!!Form::textarea('description',null,['class'=>'form-control','id'=>'description'])!!}

</div>