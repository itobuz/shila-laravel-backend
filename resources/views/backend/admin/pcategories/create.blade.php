@extends('main')
@section('content')
<!-- Content Header (Category header) -->
<section class="content-header">
    <h1>
        Create New Product Category
        <small>product category details</small>
    </h1>
</section>


<!-- Main content -->
<section class="content">
    @include('common.message')
    {!!Form::open(['url'=>'dashboard/admin/product-categories','files'=>true])!!}
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Category Details</div>
                <div class="panel-body">
                    @include('backend.admin.pcategories.fields')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-block">
                <i class="fa fa-save"></i>
                Create Category
            </button>
        </div>
    </div>

    {!!Form::close()!!}
</section><!-- /.content -->
@endsection