@extends('main')
@section('content')
<!-- Content Header (page header) -->
<section class="content-header">
    <h1>Shop Settings</h1>
</section>
<!-- Main content -->
<section class="content">
    @include('common.message')
    @if(count($settings)>0)
    <div class="row">
        <div class="col-lg-8">

            <div class="form-group">
                {!!Form::label('stripe_secret_key','Stripe secret key: ')!!}
                {!! $settings->stripe_secret_key !!}

            </div>
            <div class="form-group">
                {!!Form::label('stripe_public_key','Stripe public key: ')!!}
                {!! $settings->stripe_public_key !!}

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <a class="btn btn-primary pull-left" href="{!! url('dashboard/admin/eshop/'.$settings->id.'/edit') !!}">
                <i class="fa fa-save"></i>
                Edit Settings
            </a>
        </div>
    </div>

    @else

    <div class="row">
        <div class="col-md-8">
            <a class="btn btn-primary pull-left" href="{!! url('dashboard/admin/eshop/create') !!}">
                <i class="fa fa-save"></i>
                Create Settings
            </a>
        </div>
    </div>
    @endif

</section>
<!-- content -->
@endsection