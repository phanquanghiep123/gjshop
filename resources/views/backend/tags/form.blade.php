<div class="form-horizontal">
    @if (isset($model))
        {!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['gjadmin.quotes.update', $model->id]]) !!}
        {!! Former::populate($model) !!}
    @else
        {!! Form::open(['files' => true, 'route' => 'gjadmin.quotes.store']) !!}
    @endif
    

    <div class="form-group">
        {!! Form::label('name', 'Main Category:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
        
            <select name="sub_category_id" class="form-control">
                @foreach( $selected_cats as $cat)
                    <option value="{!! $cat->id !!}">{!! $cat->name !!} - ( {!! $cat->maincategory->name !!}  )</option>
                @endforeach
            </select>

        </div>
    </div>

	<div class="form-group">
	    {!! Form::label('autor', 'Autor:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Form::text('author', null, ['class' => 'form-control']) !!}
	    </div>
	</div>

    <div class="form-group">
        {!! Form::label('autor', 'Quote:', ['class' => 'col-md-2 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('quote', null, ['class' => 'form-control']) !!}
        </div>
    </div>



	<div class="form-group">
	    {!! Form::label('status', 'Status:', ['class' => 'col-md-2 control-label']) !!}
	    <div class="col-sm-9">
	        {!! Former::select('status','')->options(array('1'=>'Active','2'=>'Inactive' ))->class('form-control') !!}
	    </div>
	</div>

    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>