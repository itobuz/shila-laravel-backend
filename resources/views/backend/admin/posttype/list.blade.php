@extends('main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Roles        <small>available system post types</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    @include('common.message')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">available system types</h3>
            <div class="box-tools">
                <a href="{!!url('dashboard/admin/posttype/create')!!}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i>
                    Add Post type                </a>
            </div>
        </div>
        <div class="box-body table-responsive no-padding" id="users-table-wrapper">
            <table class="table table-hover">
                <thead>
                    <tr><th>Name</th>
                        <th class="text-center">Action</th>
                    </tr></thead>
                <tbody>
                    @foreach($posttypes as $posttype)

                    <tr>
                        <td>{!!$posttype->name!!}</td>
                        <td class="text-center">
                            <a href="{!!url('dashboard/admin/posttype/'.$posttype->id.'/edit')!!}" class="btn btn-primary btn-circle" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit User">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['posttype.destroy', $posttype->id],'method'=>'DELETE', 'class'=>'inline']) !!}
                            <button class="btn btn-primary btn-circle delete-button"><i class="glyphicon glyphicon-trash"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</section><!-- /.content -->
@endsection