<section class="col-lg-8">
    <div class="col-lg-12">

        <div class="form-group">
            {!!Form::label('product_title','Product Title')!!}
            {!!Form::text('product_title',null,['class'=>'form-control','placeholder'=>'Product title','required'])!!}

        </div>
        <div class="form-group">
            {!!Form::label('product_content','Product Content')!!}
            {!!Form::textarea('product_content',null,['class'=>'form-control product-content','placeholder'=>'Product Content','required'])!!}

        </div>
        <div class="form-group">
            {!!Form::label('product_excerpt','Product Excerpt')!!}
            {!!Form::textarea('product_excerpt',null,['class'=>'form-control'])!!}

        </div>

    </div>
</section>
<section class="col-lg-4">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Publish</div>
            <div class="panel-body">
                <div class="form-group">
                    {!!Form::label('status','Status')!!}
                    {!!Form::select('product_status', ['draft'=>'Draft','publish'=>'Publish'],null, array('class' => 'form-control'))!!}

                </div>

                <div class="form-group">
                    {!!Form::label('publish_date','Publish Date')!!}
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {!!Form::text('product_date',null,['class'=>'form-control','id'=>'datepicker','placeholder'=>'Publish Date'])!!}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">
                    <i class="fa fa-save"></i>
                    {!! $buttonName !!}
                </button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Product Attributes</div>
            <div class="panel-body">
                <div class="form-group">

                    {!!Form::label('order','Order')!!}
                    {!!Form::number('menu_order',0,['class'=>'form-control'])!!}
                    {!!Form::label('sku','SKU')!!}
                    {!!Form::text('sku',null,['class'=>'form-control'])!!}
                    {!!Form::label('price','Price')!!}
                    {!!Form::text('price',null,['class'=>'form-control','required'])!!}
                    {!!Form::label('qty','Quantity')!!}
                    {!!Form::text('qty',null,['class'=>'form-control','required'])!!}

                    {!! Form::label('pcategory_list','Categories') !!}
                    {!! Form::select('pcategory_list[]', $pcategories, isset($product->pcategories) ? array_pluck($product->pcategories,'id') : '', array('multiple' => true,'required'))!!}


                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Feature Image</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class='uploaded-img'>
                        @if($product_featuredimage !='')
                        <img src="{!! asset('storage/'.$product_featuredimage)!!}" alt="{!! $product_featuredimage !!}" />
                        @endif
                    </div>
                    {!!Form::file('product_featuredimage', ['class'=>'featuredImg'])!!}
                </div>

            </div>
        </div>

    </div>
</section>
