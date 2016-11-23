@extends('main')
@section('content')
<!-- Content Header (Post header) -->
<section class="content-header">
    <div class="col-lg-12">
        <h1>
            #{!! $order->id !!}
            <small>Order details</small>
        </h1>
        <p> Payment via {!! $order->payment_type !!}
    </div>
</section>


<!-- Main content -->
<section class="content order-details">
    @include('common.message')
    <section class="col-lg-8">
        <div class="col-lg-12 column-background">
            <div class="col-lg-4">
                <h4>General Details</h4>
                <p><span class="large">Order Date: </span>  {!! $order->created_at !!}</p>
            </div>
            <div class="col-lg-4 pull-right">
                <h4>Shipping Details</h4>
                @foreach($order->shippings as $shipping)
                <p><span class="large">Address: </span></p>
                <p>
                    {!! $shipping->customer_address !!}, {!! $shipping->town !!}, {!! $shipping->state !!}, {!! $shipping->zip !!}, {!! $shipping->country !!}

                </p>
                <p><span class="large">Email: </span>{!! $shipping->customer_email !!}</p>
                <p><span class="large">Phone: </span>{!! $shipping->customer_phone !!}</p>
                @endforeach

            </div>
        </div>
        <div class="col-lg-12 column-background">
            <h4 class=""> Product Details</h4>
            <table class="table table-hover">
                <thead>
                    <tr><th>Item Image</th>
                        <th>Name</th>
                        <th>Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderitems as $orderitem)
                    <tr>
                        <td><img class="thumb" src="{!! asset('storage/'.App\Product::find($orderitem->product_id)->product_featuredimage)!!}" alt="{!! App\Product::find($orderitem->product_id)->product_featuredimage !!}" /></td>
                        <td>{!! App\Product::find($orderitem->product_id)->product_title !!}</td>
                        <td>${!! App\Product::find($orderitem->product_id)->price !!}</td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td><b>Total:</b></td>
                        <td><b>${!! $order->price !!} </b></td>
                    </tr>

                </tfoot>
            </table>

        </div>
    </section>

    @if($order->status =='processing')
    <section class="col-lg-4">
        <div class="col-lg-12 pull-right column-background">
            <h4>Action</h4>
            {{ Form::open(['url' => 'dashboard/admin/order/status','METHOD'=>'POST']) }}
            <div class="form-group">
                <input type="hidden" name="order_id" value="{!! $order->id !!}" />
                <input type="hidden" name="charge_id" value="{!! $order->chargeid !!}" />
                <select name="order-status" class="form-control">
                    <option value="processing">Processing Order</option>
                    <option value="completed">Completed Order</option>
                    <option value="refund">Refund Order</option>
                    <option value="cancel">Cancel Order</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary pull-right">
                    <i class="fa fa-save"></i>
                    Save Order
                </button>
            </div>
            {{Form::close()}}
        </div>
    </section>
    @endif
</section><!-- /.content -->
@endsection