@extends('main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit User
        <small>user details</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    @include('common.message')
    {!!Form::open(['url' => 'dashboard/profile'])!!}
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">User Details</div>
                <div class="panel-body">
                    {!! Form::hidden('id',$user->id) !!}
                    <div class="form-group">
                        {!!Form::label('name','Name')!!}
                        {!!Form::text('name',$user->name,['class'=>'form-control','id'=>'name','placeholder'=>'Full Name'])!!}

                    </div>
                    <div class="form-group">
                        {!!Form::label('email','Email')!!}
                        {!!Form::email('email',$user->email,['class'=>'form-control','id'=>'display_name','placeholder'=>'Email Address'])!!}

                    </div>
                    <div class="form-group">
                        {!!Form::label('password','Password')!!}
                        {!!Form::password('password',['class'=>'form-control','placeholder'=>'Password'])!!}
                        <input type="checkbox" onchange="document.getElementById('password').type = this.checked ? 'text' : 'password'"> Show password

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fa fa-save"></i>
                Update Profile
            </button>
        </div>
    </div>

    {!!Form::close()!!}
</section><!-- /.content -->
@endsection