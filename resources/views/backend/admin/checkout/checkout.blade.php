@extends('main')
@section('content')

<section class="content-header">
    <h1>Checkout Page</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            
            @if(\Gloudemans\Shoppingcart\Facades\Cart::count()> 0)
            @include('common.message')
            {{ Form::open(['url' => 'dashboard/admin/checkout/payment','METHOD'=>'POST','id'=>'payment-form']) }}
            <span class="payment-errors"></span>
            <div class="form-group">
                <span class="large">Total Price: {!! Cart::total() !!}</span>
            </div>

            <div class="form-group">
                {!!Form::label('first_name','First Name')!!}
                {!!Form::text('first_name',null,['class'=>'form-control','placeholder'=>'First name'])!!}

            </div>
            <div class="form-group">
                {!!Form::label('last_name','Last Name')!!}
                {!!Form::text('last_name',null,['class'=>'form-control','placeholder'=>'Last name'])!!}

            </div>
            <div class="form-group">
                {!!Form::label('email','Email')!!}
                {!!Form::email('customer_email',null,['class'=>'form-control','placeholder'=>'Email address'])!!}

            </div>
            <div class="form-group">
                {!!Form::label('phone','Phone No')!!}
                {!!Form::text('customer_phone',null,['class'=>'form-control','placeholder'=>'Phone number'])!!}

            </div>
            <div class="form-group">
                {!!Form::label('country','Country')!!}
                {!!Form::text('country',null,['class'=>'form-control','placeholder'=>'Country'])!!}

            </div>

            <div class="form-group">
                {!!Form::label('address','Address')!!}
                {!!Form::text('customer_address',null,['class'=>'form-control','placeholder'=>'Address'])!!}

            </div>

            <div class="form-group">
                {!!Form::label('town','Town / City ')!!}
                {!!Form::text('town',null,['class'=>'form-control','placeholder'=>'Town / City'])!!}

            </div>
            <div class="form-group">
                {!!Form::label('state','State ')!!}
                {!!Form::text('state',null,['class'=>'form-control','placeholder'=>'State'])!!}

            </div>

            <div class="form-group">
                {!!Form::label('zip','Zip ')!!}
                {!!Form::text('zip',null,['class'=>'form-control','placeholder'=>'Zip'])!!}

            </div>
            <div class="payment-group">
                <label>Payment Method</label>
                <div class="payment-option">

                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_type" id="optionsRadios1" value="Cash on dailivary" checked="">
                            Cash On Dailivary
                        </label>
                    </div>
                    @if(count(\App\ShopSetting::all())>0)
                    <div class="radio">
                        <label>
                            <input type="radio" name="payment_type" id="optionsRadios2" value="Credit card">
                            Credit Card Payment
                        </label>
                    </div>
                    @endif

                </div>
                @if(count(\App\ShopSetting::all())>0)
                <div class="credit-card-form">
                    <div class="form-group">
                        {!!Form::label('card','Card Number ')!!}
                        <input type="text" size="20" data-stripe="number" class="form-control">
                    </div>

                    <div class="form-group">
                        {!!Form::label('exp','Expiration (MM/YY) ')!!}
                        <div>
                            <input type="text" size="2" data-stripe="exp_month">
                            <span> / </span>
                            <input type="text" size="2" data-stripe="exp_year">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>
                            {!!Form::label('cvc','CVC ')!!} 
                            <input type="text" size="4" data-stripe="cvc" class="form-control">
                        </label>
                    </div>
                </div>
                @endif
            </div>
            <input type="submit" class="submit btn btn-primary pull-right" value="Place Order" />
            {{ Form::close()}}
            @else
            <h2>You have nothing in cart.</h2>
            <a href="{!!url('dashboard/admin/product')!!}" class="btn btn-sm btn-success">
                <i class="fa fa-cart-plus"></i>
                Go to Shop               </a>
            @endif
        </div>
    </div>
</section>
@endsection
