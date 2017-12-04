@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Reward Vouchers</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="{!! route('gjadmin.vouchers.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-file-o pr5"></span> Add Voucher</a>
</div>
@stop






@section('content')

<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>Reward Vouchers
      </div>
    </div>
    <div class="panel-body pn">
    	<div class="table-responsive">
	      <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
	        <thead>
	          <tr>
                	<th class="text-center">Select</th>
        			<th class="text-center">#</th>
        			<th>Code</th>
					<th>Multiple Use </th>
					<th>Amount </th>
					<th>Assigned</th>
					<th>Validaty</th>
					<th>Added By</th>
					<th>Status</th>
					<th>Redeemed</th>
					<th>Action</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($vouchers as $voucher)
	          <tr>
      				<td class="text-center">
        				<label class="option block mn">
        				  <input type="checkbox" name="mobileos" value="FR">
        				  <span class="checkbox mn"></span>
        				</label>
      				</td>
					<td class="text-center">{!! $index !!}</td>
					<td>{!! $voucher->code !!}</td>
					<td>{!! $voucher->multiple_use == '1' ? 'Yes' : 'Single' !!}</td>
					<td class="text-center">{!! $voucher->discount_type == 'percent' ? $voucher->discount_amount. '%' : '£'.$voucher->discount_amount !!} </td>
					<td>{!! $voucher->assigned_to_user != '' ? $voucher->assignee->full_name : 'N/A' !!}</td>
					<td>
						@if( $voucher->valid_from )
							{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$voucher->valid_from)->format('d M Y') !!}
							-
							{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$voucher->valid_until)->format('d M Y') !!}
						@else
							Permanent
						@endif
					</td>
					<td>{!! $voucher->created_by != '' ? $voucher->creator->f_name : 'N/A' !!}</td>
              		<td>{!! $voucher->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!} </td>
					<td class="text-center">
						@if( $voucher->used_date )
							{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$voucher->used_date)->format('d M Y') !!}
						@else
							N/A
						@endif
					</td>
					<td>
						<div class="actions pull-right">
                        	<div class="btn-group">
								<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
									<span class="caret ml5"></span>
								</button>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="{!! route('gjadmin.vouchers.edit',$voucher->id) !!}"> 
											<i class="i"></i> <i class="fa fa-pencil"></i> Edit voucher
										</a>
									</li>
									<li class="divider"></li>
									<li>
										{!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.vouchers.destroy', $voucher->id]]) !!}                                    
										<button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete voucher</button>
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