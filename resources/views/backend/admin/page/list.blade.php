@extends('main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Pages        <small>available system pages</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    @include('common.message')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">available system pages</h3>
                    <div class="box-tools">
                        <a href="{!!url('dashboard/admin/page/create')!!}" class="btn btn-sm btn-success">
                            <i class="fa fa-plus"></i>
                            Add Page                </a>
                    </div>
                </div>
                <div class="box-body" id="posts-table-wrapper">
                    <table id="page-datatable-list" class="table table-hover table-condensed table-bordered table-hover dataTable">
                        <thead>
                            <tr>
                                <th class="col-md-3">{{{ Lang::get('Title') }}}</th>
                                <th class="col-md-3">{{{ Lang::get('Status') }}}</th>
                                <th class="col-md-3">{{{ Lang::get('Date') }}}</th>
                                <th class="col-md-3">{{{ Lang::get('Action') }}}</th>

                            </tr>
                        </thead>
                    </table>


                </div>
            </div>
        </div>
    </div>
</section><!-- /.content -->
@endsection