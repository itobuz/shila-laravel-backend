@extends('main')
@section('content')
<!-- Content Header (page header) -->
<section class="content-header">
    <h1>
        Create New Page
        <small>page details</small>
    </h1>
</section>
<!-- Main content -->
<section class="content">
    @include('common.message')
    <div class="row">
        {!!Form::open(['url'=>'dashboard/admin/page','files' => true])!!}
        @include('backend.admin.page.fields',['buttonName' => 'Create'])
        {!!Form::close()!!} 
    </div>

</section>
<!-- content -->
@endsection
