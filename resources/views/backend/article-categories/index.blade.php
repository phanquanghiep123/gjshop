@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Article Categories</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="{!! route('gjadmin.article-categories.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-file-o pr5"></span> Add Article Category</a>
</div>
@stop

@section('content')
	<div class="row">
	 <div class="col-md-12">
	  <div class="panel panel-visible" id="spy5">
	    <div class="panel-heading">
	      <div class="panel-title hidden-xs">
	        <span class="glyphicon glyphicon-tasks"></span>Article Categories</div>
	    </div>
	    <div class="panel-body pn">
	    	<div class="table-responsive">
		      <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
		        <thead>
		          <tr>
		          	<th></th>
	                <th class="text-center">#</th>
	                <th>List Image</th>
					<th sortable>Name</th>
					<th sortable>Parent</th>
					<th sortable>Position</th>
					<th sortable>Slug</th>
					<th sortable>Status</th>
					<th class="text-center">Created</th>
					<th class="text-center">Action</th>
		          </tr>
		        </thead>
		        <tbody>
		          @foreach ($categories as $category)
	                <tr>
	                	<td class="text-center">
							<label class="option block mn">
								<input type="checkbox" name="mobileos" value="FR">
								<span class="checkbox mn"></span>
							</label>
						</td>
	                	<td class="text-center">{!! $index !!}</td>
	                	<td> <img src="{!! $category->list_image !!}" width="90"> </td>
						<td><a href="{!! route('gjadmin.article-categories.edit',$category->id) !!}">{!! $category->name !!}</a></td>
						<td>{!! $category->parent ? $category->parent->name : 'N/A' !!}</td>
						<td>{!! $category->position !!}</td>
						<td>{!! $category->slug !!}</td>
						<td>{!! $category->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-warning btn-block">Inactive</button>' !!} </td>
						<td class="text-center">{!! $category->created_at !!}</td>
		                <td>
		                	<div class="actions pull-right">
		                        <div class="btn-group">
								  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
								    <span class="caret ml5"></span>
								  </button>
								  <ul class="dropdown-menu" role="menu">
								   
					                <li>
					                  <a href="{!! route('gjadmin.article-categories.edit',$category->id) !!}"> 
					                    <i class="i"></i> <i class="fa fa-pencil"></i> Edit Category
					                  </a>
					                </li>
								    <li class="divider"></li>
								    <li>
								    	{!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.article-categories.destroy', $category->id]]) !!}                                    
	                                    <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Categpry</button>
	                                    {!! Form::close() !!}
					                </li>
								  </ul>
								</div>
		                    </div>
	                	</td>
		         	</tr>
		          <?php $index++; ?>
		          @endforeach
		        </tbody>
		      </table>
		     </div>
	    </div>
	    
	  </div>
	</div>
</div>
@stop


@section('styles')

@endsection



@section('plugins')

@endsection



@section('scripts')

@endsection