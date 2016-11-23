@extends('main')
@section('content')
<!-- Content Header (Post header) -->
<section class="content-header">
    <h1>
        View Product
        <small>product details</small>
    </h1>
</section>


<!-- Main content -->
<section class="content">
    <div class="row">
        <section class="col-lg-6">
            <div class="col-lg-12">

                <div class="form-group">
                    <img class="product-img" src="{!! asset('storage/'.$product->product_featuredimage)!!}" alt="{!! $product->product_featuredimage !!}" />
                </div>

            </div>
        </section>
        <section class="col-lg-6">
            <div class="col-lg-12">
                <h1 class="title">{!! $product->product_title !!}</h1>
                <div class="col-md-12">
                    <h3>Small Description </h3>
                    {!! $product->product_excerpt !!}
                </div>
                <div class="col-md-12">
                    <p><span class="large">Price: </span>  {!! $product->price !!}</p>

                    <p><span class="large">Sku: </span>  {!! $product->sku !!}</p>

                    <p><span class="large">Categories: </span>
                        @foreach($product-> pcategories as $category)
                        {!! $category->name !!},
                        @endforeach
                    </p>
                </div>

                <div class="col-md-12">
                    @if(($product->qty)> 0)
                    <p><span class="large">Quantity: </span>  {!! $product->qty !!}</p>
                    {!! Form::open(['action'=>'CartController@postAddToCart']) !!}
                    <input type="hidden" name="id" value="{!! $product->id !!}" />
                    <div><p class="range-dropdown">{{ Form::selectRange('qty', 1,$product->qty) }}</p></div>
                    <button type="submit" class="btn btn-primary pull-left">
                        <i class="fa fa-cart-plus"></i>
                        Add To Cart
                    </button>
                    {!! Form::close() !!}
                    @else
                    <span class="out-of-stock"> Out of Stock </span>
                    @endif
                </div>


        </section>
        <section class="col-lg-12">
            <hr class="shila-border">
            <h3>Description </h3>
            <div class="description">
                {!! $product->product_content !!}
            </div>
        </section>

    </div>

</section><!-- /.content -->
@endsection