@extends('main')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Orders        <small>trash orders</small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    @include('common.message')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">trashed orders</h3>
                 
                </div>
                <div class="box-body table-responsive no-padding" id="users-table-wrapper">
                    @if(count($orders)>0)
                    <table class="table table-hover">
                        <thead>
                            <tr><th>Order Id</th>
                                <th>Purchased</th>
                                <th class="text-center">Ship to</th>
                                <th>Date</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr></thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>{!!$order->id!!}</td>

                                <td>{!!count($order->orderitems)!!}</td>

                                <td class="text-center"> @foreach($order->shippings as $shipping)
                                    {!! $shipping->customer_address !!}, {!! $shipping->town !!}, {!! $shipping->state !!}, {!! $shipping->zip !!}, {!! $shipping->country !!}

                                    @endforeach
                                </td>
                                <td>{!!$order->created_at!!}</td>
                                <td>${!!$order->price!!}</td>
                                <td class="text-center">
                                    <a href="{!!url('dashboard/admin/order/restore/'.$order->id.'')!!}" class="btn btn-primary btn-circle" title="" data-toggle="tooltip" data-placement="top" data-original-title="Restore">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                    <a href="{!!url('dashboard/admin/order/permanent-delete/'.$order->id.'')!!}" class="btn btn-primary btn-circle" title="" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                        <i class="glyphicon glyphicon-trash delete-button"></i>
                                    </a>
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
        </div>
    </div>
</section><!-- /.content -->
@endsection