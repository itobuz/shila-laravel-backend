@extends('main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Categories        <small>available system categories</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

    @include('common.message')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">available system categories</h3>
            <div class="box-tools">
                <a href="{!!url('dashboard/admin/categories/create')!!}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i>
                    Add Category                </a>
            </div>
        </div>
        <div class="box-body table-responsive no-padding" id="users-table-wrapper">
            @if(count($categories)>0)
            <table class="table table-hover">
                <thead>
                    <tr><th>Name</th>
                        <th>Description</th>
                        <th class="text-center">Action</th>
                    </tr></thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{!!$category->name!!}</td>

                        <td>{!! $category->description !!}</td>

                        <td class="text-center">
                            <a href="{!!url('dashboard/admin/categories/'.$category->id.'/edit')!!}" class="btn btn-primary btn-circle" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit Category">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['categories.destroy', $category->id],'method'=>'DELETE', 'class'=>'inline']) !!}
                            <button class="btn btn-primary btn-circle delete-button"><i class="glyphicon glyphicon-trash"></i></button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            @else
            <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-info"></i> Alert!</h4>
                No records found.
            </div>
            @endif
        </div>
    </div>

</section><!-- /.content -->
@endsection