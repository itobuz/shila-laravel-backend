@extends('main')
@section('content')
<!-- Content Header (page header) -->
<section class="content-header">
    <h1>
        Edit Page
        <small>page details</small>
    </h1>
</section>


<!-- Main content -->
<section class="content">
    <div class="row">
        {!!Form::model($page, ['route' => ['page.update', $page->id],'method'=>'put', 'files'=>true])!!}
        @include('backend.admin.page.fields', ['buttonName' => 'Update'])
        {!!Form::close()!!}
    </div>

</section><!-- /.content -->
@endsection