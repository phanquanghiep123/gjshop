@extends('layouts.backend')


@section('breadcrumb')
	<ol class="breadcrumb">
	    <li class="crumb-active">
	      <a href="{!! route('dashboard') !!}">Dashboard</a>
	    </li>
	    <li class="crumb-icon">
	        <span class="glyphicon glyphicon-home"></span>
	    </li>
	    <li class="crumb-trail">Postage Rates</li>
	</ol>
@stop

@section('breadcrumb_right')
	<div class="topbar-right hidden-xs hidden-sm">
	  <a href="{{ route('gjadmin.postage-rates.create') }}" class="btn btn-default btn-sm light fw600 ml10">
	    <span class="fa fa-plus pr5"></span> Add Postage Rate</a>
	</div>
@stop


@section('content')

<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
		<div class="panel-title hidden-xs">
			<span class="glyphicon glyphicon-tasks"></span>Postage Rates
		</div>
    </div>
    
    <div class="panel-body pn">
        <div class="table-responsive">
          <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="text-center">Select</th>
                <th class="text-center">#</th>
                <th>Company</th>
				<th>Rate</th>
				<th>Origin</th>
				<th>Dest</th>

				<th>Min Weight</th>
				<th>Max Weight</th>

				<th>Service</th>
				<th>Duration</th>
				<th>Size</th>
				<th>Fee</th>

				<th>Status</th>
				<th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($postageRates as $rate)
	                <tr>
						<td class="text-center">
							<label class="option block mn">
							  <input type="checkbox" name="mobileos" value="FR">
							  <span class="checkbox mn"></span>
							</label>
						</td>
						<td class="text-center">{!! $index !!}</td>
						<td>{!! $rate->courier->name !!}</td>
						<td>{!! $rate->name !!}</td>
						<td>{!! $rate->origin !!}</td>
						<td>{!! $rate->destination !!}</td>

						<td>{!! $rate->min_weight !!}</td>
						<td>{!! $rate->max_weight !!}</td>

						<td>{!! $rate->service !!}</td>
						<td>{!! $rate->duration !!}</td>
						<td>{!! $rate->size !!}</td>
						<td>{!! $rate->origin == 'UK' ? '£' : '$' !!} {{ number_format($rate->fee, 2, '.', '') }}</td>

           				<td>{!! $rate->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!} </td>
	                    <td>
	                        <div class="actions pull-right">
	                            <div class="btn-group">
	                              <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
	                                <span class="caret ml5"></span>
	                              </button>
	                              <ul class="dropdown-menu" role="menu">
	                                <li>
	                                    <a href="{!! route('gjadmin.postage-rates.edit', $rate->id) !!}"> 
	                                        <i class="i"></i> <i class="fa fa-pencil"></i> Edit Rate
	                                    </a>
	                                </li>
	                                <li class="divider"></li>
	                                <li>
	                                    {!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.postage-rates.destroy', $rate->id]]) !!}                                    
	                                    <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Rate</button>
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



@section('plugins')

@endsection



@section('scripts')

@endsection