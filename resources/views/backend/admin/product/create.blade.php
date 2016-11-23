@extends('main')
@section('content')
<!-- Content Header (Post header) -->
<section class="content-header">
    <h1>
        Create New Product
        <small>product details</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        @if(count(\App\Pcategory::all())>0)
        @include('common.message')
        {!!Form::open(['url'=>'dashboard/admin/product','files' => true])!!}
        @include('backend.admin.product.fields',['buttonName' => 'Create'])
        {!!Form::close()!!} 
        @else
        <div class="col-lg-12">
            <h3>Please create a product <a href="{!! url('dashboard/admin/product-categories/create') !!}">category</a> first.</h3>
        </div>
        @endif
    </div>

</section>
<!-- content -->
@endsection
