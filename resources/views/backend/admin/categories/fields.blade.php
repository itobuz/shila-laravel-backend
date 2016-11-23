<div class="form-group">
    {!!Form::label('name','Name')!!}
    {!!Form::text('name',null,['class'=>'form-control','id'=>'name','placeholder'=>'Category Name'])!!}

</div>
<div class="form-group">
    {!!Form::label('description','Description')!!}
    {!!Form::textarea('description',null,['class'=>'form-control'])!!}

</div>
<div class="form-group">
    <div class='uploaded-img'>
        @if($featuredimage !='')
        <img src="{!! asset('storage/'.$featuredimage)!!}" alt="{!! $featuredimage !!}" />
        @endif
    </div>
    {!!Form::file('featuredimage', ['class'=>'featuredImg'])!!}
</div>
