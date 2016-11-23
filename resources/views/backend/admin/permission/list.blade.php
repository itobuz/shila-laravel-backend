@extends('main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Permissions        <small>available system permissions</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">available system permissions</h3>
            <div class="box-tools">
                <a href="{!!url('dashboard/admin/permission/create')!!}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i>
                    Add permission                </a>
            </div>
        </div>
        <div class="box-body table-responsive no-padding" id="users-table-wrapper">
            {!!Form::open(['url'=>'dashboard/admin/permission/attachment']) !!}
            <table class="table table-hover">
                <thead>
                    <tr><th>Name</th>
                        @foreach($roles as $role)
                        <th class="text-center">{!! $role->display_name !!}</th>
                        @endforeach
                        <th class="text-center">Action</th>
                    </tr></thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{!!$permission->name!!}</td>
                        @foreach($roles as $role)
                        <td class="text-center">
                            <div class="checkbox" id="rolecheck">

                                {!!Form::checkbox('permissioncheck', $role->id , $role->hasPermission($permission->name), array('data-permission' => $permission->id))!!}

                            </div>

                            @endforeach
                        </td>
                        <td class="text-center">
                            <a href="{!!url('dashboard/admin/permission/'.$permission->id.'/edit')!!}" class="btn btn-primary btn-circle" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit Permission">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            {!! Form::close() !!}
        </div>
    </div>

</section><!-- /.content -->
@endsection