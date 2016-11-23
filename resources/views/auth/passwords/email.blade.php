@extends('layouts.app')

<!-- Main Content -->
@section('content')

<div class="register-box-body">
    <p class="login-box-msg">Reset Password</p>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}

        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="row">
            <div class="col-xs-4">

            </div>
            <!-- /.col -->
            <div class="col-xs-8">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>


@endsection
