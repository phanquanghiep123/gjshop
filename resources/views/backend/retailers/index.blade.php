@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Retailers</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="{!! route('gjadmin.retailers.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-file-o pr5"></span> Add Retailer</a>
</div>
@stop






@section('content')

<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>Retailers
      </div>
    </div>
    <div class="panel-body pn">
    	<div class="table-responsive">
	      <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
	        <thead>
	          <tr>
                	<th class="text-center">Select</th>
        			<th class="text-center">#</th>
					<th>Company </th>
					<th>Region </th>
					<th class="none">Country</th>
					<th class="none">Website</th>
					<th class="none">Contact</th>
					<th class="none">Contact #</th>
					<th class="none">Address</th>
					<th>Status</th>
					<th class="text-center">Action</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($retailers as $retailer)
	          <tr>
      				<td class="text-center">
        				<label class="option block mn">
        				  <input type="checkbox" name="mobileos" value="FR">
        				  <span class="checkbox mn"></span>
        				</label>
      				</td>
					<td class="text-center">{!! $index !!}</td>
					<td style="white-space:nowrap;">{!! $retailer->company !!}</td>
					<td style="white-space:nowrap;">{!! str_replace("_", " ", ucwords( $retailer->region )) !!}</td>
					<td style="white-space:nowrap;">{!! $retailer->country !!}</td>
					<td style="white-space:nowrap;">{!! $retailer->website !!}</td>
					<td style="white-space:nowrap;">{!! $retailer->contact_name !!}</td>
					<td style="white-space:nowrap;">{!! $retailer->contact_number !!}</td>
					<td style="white-space:nowrap;">{!! $retailer->head_office !!}</td>
					
              		<td>{!! $retailer->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!} </td>
					<td>
						<div class="actions pull-right">
                        	<div class="btn-group">
								<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
									<span class="caret ml5"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="{!! route('gjadmin.retailers.show',$retailer->id) !!}"> 
											<i class="i"></i> <i class="fa fa-eye"></i> View retailer
										</a>
									</li>
									<li>
										<a href="{!! route('gjadmin.retailers.edit',$retailer->id) !!}"> 
											<i class="i"></i> <i class="fa fa-pencil"></i> Edit retailer
										</a>
									</li>
									<li class="divider"></li>
									<li>
										{!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.retailers.destroy', $retailer->id]]) !!}                                    
										<button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete retailer</button>
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