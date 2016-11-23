<section class="col-lg-8">
    <div class="col-lg-12">
        <input type="hidden" name="posttype_id" value="{{App\Posttype::whereName('post')->first()->id}}" />
        <div class="form-group">
            {!!Form::label('post_title','Post Title')!!}
            {!!Form::text('post_title',null,['class'=>'form-control','placeholder'=>'Post title'])!!}

        </div>
        <div class="form-group">
            {!!Form::label('post_content','Post Content')!!}
            {!!Form::textarea('post_content',null,['class'=>'form-control post-content','placeholder'=>'Post Content'])!!}

        </div>
        <div class="form-group">
            {!!Form::label('post_excerpt','Post Excerpt')!!}
            {!!Form::textarea('post_excerpt',null,['class'=>'form-control'])!!}

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
                    {!!Form::select('post_status', ['draft'=>'Draft','publish'=>'Publish'],null, array('class' => 'form-control'))!!}

                </div>

                <div class="form-group">
                    {!!Form::label('publish_date','Publish Date')!!}
                    <div class="input-group date">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        {!!Form::text('post_date',null,['class'=>'form-control','id'=>'datepicker','placeholder'=>'Publish Date'])!!}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary pull-right">
                    <i class="fa fa-save"></i>
                    {!! $buttonName !!}
                </button>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Post Attributes</div>
            <div class="panel-body">
                <div class="form-group">

                    {!!Form::label('order','Order')!!}
                    {!!Form::number('menu_order',0,['class'=>'form-control'])!!}
                    
                    {!! Form::label('category_list','Categories') !!}
                    {!! Form::select('category_list[]', $categories, isset($post->categories) ? array_pluck($post->categories,'id') : '', array('multiple' => true,'class'=>'form-control'))!!}

                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Feature Image</div>
            <div class="panel-body">
                <div class="form-group">
                    <div class='uploaded-img'>
                        @if($post_featuredimage !='')
                        <img src="{!! asset('storage/'.$post_featuredimage)!!}" alt="{!! $post_featuredimage !!}" />
                        @endif
                    </div>
                    {!!Form::file('post_featuredimage', ['class'=>'featuredImg'])!!}
                </div>

            </div>
        </div>

    </div>
</section>
