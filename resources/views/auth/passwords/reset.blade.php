@extends('layouts.app')

@section('content')

<div class="register-box-body">
    <p class="login-box-msg">Reset Password</p>

    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $email or old('email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>
        <div class="form-group has-feedback">
            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>
        <div class="row">
            <div class="col-xs-4">

            </div>
            <!-- /.col -->
            <div class="col-xs-8">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
            </div>
            <!-- /.col -->
        </div>
    </form>
</div>
@endsection
