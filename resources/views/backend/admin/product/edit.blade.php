@extends('main')
@section('content')
<!-- Content Header (Post header) -->
<section class="content-header">
    <h1>
        Edit Post
        <small>post details</small>
    </h1>
</section>


<!-- Main content -->
<section class="content">
    @include('common.message')
    <div class="row">
        {!!Form::model($product, ['action' => ['ProductController@update', $product->id],'method'=>'PATCH', 'files'=>true])!!}
        @include('backend.admin.product.fields', ['buttonName' => 'Update'])
        {!!Form::close()!!}
    </div>

</section><!-- /.content -->
@endsection