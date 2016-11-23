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
    <div class="row">
        {!!Form::model($post, ['route' => ['post.update', $post->id],'method'=>'put', 'files'=>true])!!}
        @include('backend.admin.post.fields', ['buttonName' => 'Update'])
        {!!Form::close()!!}
    </div>

</section><!-- /.content -->
@endsection