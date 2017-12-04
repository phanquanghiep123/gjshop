@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Slides</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="{!! route('gjadmin.slides.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-file-o pr5"></span> Add Slide</a>
</div>
@stop






@section('content')

<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>Slides
      </div>
    </div>
    <div class="panel-body pn">
    	<div class="table-responsive">
	      <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
	        <thead>
	          <tr>
                	<th class="text-center">Select</th>
        			<th class="text-center">#</th>
					<th>Image </th>
					<th>Order</th>
					<th>Caption</th>
					<th>Colour </th>
					<th>Position</th>
					<th class="none">Status</th>
					<th class="text-center">Action</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($slides as $slide)
	          <tr>
      				<td class="text-center">
        				<label class="option block mn">
        				  <input type="checkbox" name="mobileos" value="FR">
        				  <span class="checkbox mn"></span>
        				</label>
      				</td>
					<td class="text-center">{!! $index !!}</td>
					<td><img src="{!! asset($slide->image) !!}" width="300"></td>
					<td>{!! $slide->order !!}</td>
					<td>{!! $slide->caption !!}</td>
					<td>{!! $slide->caption_colour !!} </td>
					<td>{!! $slide->caption_position !!} </td>
              		<td>{!! $slide->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!} </td>
					
					<td>
						<div class="actions pull-right">
                        	<div class="btn-group">
								<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
									<span class="caret ml5"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="{!! route('gjadmin.slides.show',$slide->id) !!}"> 
											<i class="i"></i> <i class="fa fa-eye"></i> View Slide
										</a>
									</li>
									<li>
										<a href="{!! route('gjadmin.slides.edit',$slide->id) !!}"> 
											<i class="i"></i> <i class="fa fa-pencil"></i> Edit Slide
										</a>
									</li>
									<li class="divider"></li>
									<li>
										{!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.slides.destroy', $slide->id]]) !!}                                    
										<button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Slide</button>
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