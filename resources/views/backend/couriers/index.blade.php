@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Couriers</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="{!! route('gjadmin.couriers.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-file-o pr5"></span> Add Courier</a>
</div>
@stop






@section('content')

<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>Couriers
      </div>
    </div>
    <div class="panel-body pn">
    	<div class="table-responsive">
	      <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
	        <thead>
	          <tr>
                	<th class="text-center">Select</th>
        			<th class="text-center">#</th>
					<th>Courier </th>
					<th>Status</th>
					<th class="none">Added</th>
					<th class="text-center">Action</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($couriers as $courier)
	          <tr>
      				<td class="text-center">
        				<label class="option block mn">
        				  <input type="checkbox" name="mobileos" value="FR">
        				  <span class="checkbox mn"></span>
        				</label>
      				</td>
					<td class="text-center">{!! $index !!}</td>
					<td style="white-space:nowrap;">{!! $courier->name !!}</td>
              		<td>{!! $courier->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!} </td>
					<td>{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$courier->created_at)->format('d M Y') !!}</td>
					<td>
						<div class="actions pull-right">
                        	<div class="btn-group">
								<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
									<span class="caret ml5"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="{!! route('gjadmin.couriers.edit',$courier->id) !!}"> 
											<i class="i"></i> <i class="fa fa-pencil"></i> Edit Courier
										</a>
									</li>
									<li class="divider"></li>
									<li>
										{!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.couriers.destroy', $courier->id]]) !!}                                    
										<button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Courier</button>
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