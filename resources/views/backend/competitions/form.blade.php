@if (isset($model))
{!! Form::model($model, ['files' => true, 'method' => 'PUT', 'route' => ['gjadmin.competitions.update', $model->id]]) !!}
{!! Former::populate($model) !!}
@else
{!! Form::open(['files' => true, 'route' => 'gjadmin.competitions.store']) !!}
@endif


<div class="form-horizontal">

    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Name:</label>
        <div class="col-sm-9">
            {!! Former::text('name','')->class('form-control') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Slug:</label>
        <div class="col-sm-9">
            {!! Former::text('slug','')->class('form-control') !!}
        </div>
    </div>
  
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Description:</label>
        <div class="col-sm-9">
            {!! Former::textarea('description','')->class('form-control summernote') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Prize Image:</label>
        <div class="col-sm-9">
            {!! Former::text('prize_image','')->class('form-control') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Poster Image:</label>
        <div class="col-sm-9">
            {!! Former::text('list_image','')->class('form-control') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Image Background Colour:</label>
        <div class="col-sm-9">
            {!! Former::text('bg_colour','')->class('form-control') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Image ALT Text:</label>
        <div class="col-sm-9">
            {!! Former::text('image_alt','')->class('form-control') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Start Date:</label>
        <div class="col-sm-9">


        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">End Date:</label>
        <div class="col-sm-9">

        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Status:</label>
        <div class="col-sm-9">
            {!! Form::select('status', array('1'=>'Active','2'=>'Inactive'),null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Winner:</label>
        <div class="col-sm-9">
            {!! Former::text('winner','')->class('form-control') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="title" class="col-md-2 control-label">Country:</label>
        <div class="col-sm-9">
            {!! Former::text('country','')->class('form-control') !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label"></label>
        <div class="col-sm-9">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>

{!! Form::close() !!}










