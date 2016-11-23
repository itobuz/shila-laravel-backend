@extends('main')
@section('content')
<!-- Content Header (Post header) -->
<section class="content-header">
    <h1>
        Cart
        <small>cart details</small>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-10 col-md-12 col-sm-12">
            @if(count(Cart::content()) >0)
            <table class="table cart-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Product</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach (Cart::content() as $row)
                    {!! Form::open(['action'=>'CartController@postUpdateCart']) !!}
                    <tr>
                        <td><a class="delete-button" href="{!!url('dashboard/admin/cart/remove-cart-item/'.$row->rowId)!!}" class="btn btn-sm btn-success">
                                <i class="fa fa-trash"></i></a></td>
                        <td>
                            <p><strong>{!! $row->name !!}</strong></p>

                        </td>
                        <td><img class="small-img" src="{!! asset('storage/'.$row->options->image)!!}" alt="{!! $row->options->image !!}" /></td>
                        <td><input name="qty" type="text" value="{!! $row->qty !!}"></td>
                        <td>${!! $row->price !!}</td>
                        <td>${!! $row->total !!}</td>
                        <td>
                            <input type="hidden" name='id' value="{!! $row->rowId !!}" />
                            <button type="submit" class="btn btn-primary pull-right">
                                <i class="fa fa-cart-plus"></i>
                                Update Cart
                            </button>
                        </td>
                    </tr>
                    {!! Form::close() !!}

                    @endforeach

                </tbody>

                <tfoot>
                    <tr class="cart-total">
                        <td colspan="4">&nbsp;</td>
                        <td colspan="3">Cart Totals</td>
                        
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">Subtotal</td>
                        <td><?php echo Cart::subtotal(); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">Tax</td>
                        <td><?php echo Cart::tax(); ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">Total</td>
                        <td><?php echo Cart::total(); ?></td>
                    </tr>
                </tfoot>
            </table>
            <a href="{!!url('dashboard/admin/checkout/payment/')!!}" class="btn btn-primary pull-right">Proceed to checkout</a>
            @else
            <h2>Cart items not found </h2>
            @endif
        </div>
    </div>

</section>
@endsection