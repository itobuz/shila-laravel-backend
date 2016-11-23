@extends('main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users        <small>available system users</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">

 @include('common.message')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">available system users</h3>
            <div class="box-tools">
                <a href="{!!url('dashboard/admin/user/create')!!}" class="btn btn-sm btn-success">
                    <i class="fa fa-plus"></i>
                    Add User                </a>
            </div>
        </div>
        <div class="box-body table-responsive no-padding" id="users-table-wrapper">
            @if(count($users)>0)
            <table class="table table-hover">
                <thead>
                    <tr><th>Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Role</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr></thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{!!$user->name!!}</td>

                        <td class="text-center">{!!$user->email!!}</td>
                        <td class="text-center">
                            @foreach($user->roles as $role)
                            {!!$role->display_name!!}
                            @endforeach
                        </td>
                        <td class="text-center">
                            @if($user->status=='1')
                            <small class="label bg-green">Active</small>
                            @else
                            <small class="label bg-red">Inactive</small>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{!!url('dashboard/admin/user/'.$user->id.'/edit')!!}" class="btn btn-primary btn-circle" title="" data-toggle="tooltip" data-placement="top" data-original-title="Edit User">
                                <i class="glyphicon glyphicon-edit"></i>
                            </a>
                            {!! Form::open(['route' => ['user.destroy', $user->id],'method'=>'DELETE', 'class'=>'inline']) !!}
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