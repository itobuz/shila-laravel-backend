@extends('frontend.main')
@section('content')
<!-- Content Header (Post header) -->
<section class="content-header">
    <h1>Shop Page</h1>
</section>
<section class="content">
    <div class="row shop-list">
        @foreach($products as $product)
        <div class="col-lg-3 col-xs-6">
            <div class="small-box">
                <div class="inner">
                    <a href="{!! url('products/view/'.$product->id) !!}"> <img src="{!! asset('storage/'.$product->product_featuredimage)!!}" alt="{!! $product->product_title !!}" /> </a>
                    <h4><a href="{!! url('products/view/'.$product->id) !!}"> {!! $product->product_title !!} </a></h4>

                    <p>${!! $product->price !!}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row pull-right">
        {{ $products->links() }}
    </div>
</section>
@endsection