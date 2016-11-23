@extends('main')
@section('content')
<!-- Content Header (Post header) -->
<section class="content-header">
    <h1>
        Create New Post
        <small>post details</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        @if(count(\App\Category::all())>0)
        {!!Form::open(['url'=>'dashboard/admin/post','files' => true])!!}
        @include('backend.admin.post.fields',['buttonName' => 'Create'])
        {!!Form::close()!!} 
        @else
        <div class="col-lg-12">
            <h3>Please create a post <a href="{!! url('dashboard/admin/categories/create') !!}">category</a> first.</h3>
        </div>
        @endif
    </div>

</section>
<!-- content -->
@endsection
