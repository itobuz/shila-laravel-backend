@extends('main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Roles        <small>available system roles</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">available system roles</h3>
            <div class="box-tools">
                <a href="{!!url('dashboard/admin/role/create')!!}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i>
                    Add Role                </a>
            </div>
        </div>
        <div class="box-body table-responsive no-padding" id="users-table-wrapper">
            <table class="table table-hover">
                <thead>
                    <tr><th>Name</th>
                        <th>Display Name</th>
                        <th># of users with this role</th>
                        <th class="text-center">Action</th>
                    </tr></thead>
                <tbody>
                    @foreach($roles as $role)
                
                    <tr>
                        <td>{!!$role->name!!}</td>
                        <td>{!!$role->display_name!!}</td>
                        <td>{!! count($role->users) !!}</td>
                        <td class="text-center">
                            <a href="{!!url('dashboard/admin/role/'.$role->id.'/edit')!!}" class="btn btn-primary btn-circle" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit Role">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

</section><!-- /.content -->
@endsection