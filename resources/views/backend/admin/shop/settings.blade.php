@extends('main')
@section('content')
<!-- Content Header (page header) -->
<section class="content-header">
    <h1>Shop Settings</h1>
</section>
<!-- Main content -->
<section class="content">

    {!!Form::open(['url'=>'dashboard/admin/eshop'])!!}
    <div class="row">
        @include('common.message')
        <div class="col-lg-8">

            <div class="form-group">
                {!!Form::label('stripe_secret_key','Stripe secret key')!!}
                {!!Form::text('stripe_secret_key',null,['class'=>'form-control','placeholder'=>'Stripe secret key'])!!}

            </div>
            <div class="form-group">
                {!!Form::label('stripe_public_key','Stripe public key')!!}
                {!!Form::text('stripe_public_key',null,['class'=>'form-control','placeholder'=>'Stripe public key'])!!}

            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <button type="submit" class="btn btn-primary pull-right">
                <i class="fa fa-save"></i>
               Submit
            </button>
        </div>
    </div>

    {!!Form::close()!!} 


</section>
<!-- content -->
@endsection