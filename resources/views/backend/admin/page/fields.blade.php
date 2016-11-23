<section class="col-lg-8">
    <div class="col-lg-12">

        <div class="form-group">
            {!!Form::label('page_title','Page Title')!!}
            {!!Form::text('page_title',null,['class'=>'form-control','placeholder'=>'Page title'])!!}

        </div>
        <div class="form-group">
            {!!Form::label('page_content','Page Content')!!}
            {!!Form::textarea('page_content',null,['class'=>'form-control page-content','placeholder'=>'Page Content'])!!}

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
                    {!!Form::select('page_status', ['draft'=>'Draft','publish'=>'Publish'],null, array('class' => 'form-control'))!!}

                </div>

                <div class="form-group">
                    {!!Form::label('publish_date','Publish Date')!!}
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {!!Form::text('page_date',null,['class'=>'form-control','id'=>'datepicker','placeholder'=>'Publish Date'])!!}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">
                    <i class="fa fa-save"></i>
                    {!! $buttonName !!}
                </button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Page Attributes</div>
            <div class="panel-body">
                <div class="form-group">

                    {!!Form::label('order','Order')!!}
                    {!!Form::number('menu_order')!!}

                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Feature Image</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class='uploaded-img'>
                        @if($page_featuredimage !='')
                        <img src="{!! asset('storage/'.$page_featuredimage)!!}" alt="{!! $page_featuredimage !!}" />
                        @endif
                    </div>
                    {!!Form::file('page_featuredimage', ['class'=>'featuredImg'])!!}
                </div>

            </div>
        </div>

    </div>
</section>
