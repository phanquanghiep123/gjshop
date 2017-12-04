@extends('layouts.backend')


@section('breadcrumb')
<ul class="page-breadcrumb">
    <li>
        <a href="{!! route('dashboard') !!}">Dashboard</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Competitions</span>
    </li>
</ul>
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">Competitions</h3>
	</div>
	<div class="col-md-12">
		<a class="btn green sbold" data-toggle="modal" href="{!! route('gjadmin.competitions.create')  !!}"> Add competition &nbsp; <i class="fa fa-gift"></i></a>
	</div>



	<div class="col-md-12">

		 <!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light">
		    <div class="portlet-title">
		        <div class="caption">
		            <i class="fa fa-comments"></i>Registered Competitions </div>
		        <div class="tools"> </div>
		    </div>
		    <div class="portlet-body">
		        <table class="table table-striped table-hover dt-responsive" width="100%" id="sample_3" cellspacing="0" width="100%">
		            <thead>
		                <tr>
		                	<th class="text-center">#</th>
							<th>Competition </th>
							<th>Slug</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Status</th>
							<th class="none">Winner</th>
							<th class="none">Country</th>
							<th class="none">Added</th>
							<th class="text-center">Action</th>
		                </tr>
		            </thead>
		            <tbody>
		            	@foreach ($competitions as $competition)
		                <tr>
		                	<td class="text-center">{!! $no !!}</td>
							<td>{!! $competition->name !!}</td>
							<td>{!! $competition->slug !!}</td>
							<td>{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$competition->start_date)->format('D, d M Y - H:i') !!}</td>
							<td>{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$competition->end_date)->format('D, d M Y - H:i') !!}</td>
							<td>{!! ( $competition->status == 1 ? 'Active' : 'Inactive' ) !!}</td>
							<td>{!! $competition->winner !!}</td>
							<td>{!! $competition->country !!}</td>
							<td>{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$competition->created_at)->format('d M Y') !!}</td>
		                    <td>
		                    	<div class="actions pull-right">
                                    <div class="btn-group">
                                        <a class="btn green-haze btn-outline btn-sm" href="javascript:;" data-toggle="dropdown" data-close-others="true" aria-expanded="false">
                                            <i class="fa fa-gear"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{!! route('gjadmin.competitions.show', $competition->id) !!}"> 
                                                	<i class="i"></i> <i class="fa fa-eye"></i> View competition
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{!! route('gjadmin.competitions.edit', $competition->id) !!}"> 
                                                	<i class="i"></i> <i class="fa fa-pencil"></i> Edit competition
                                                </a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="javascript:;"><i class="fa fa-ban"></i> Delete competition</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

		                    </td>
		                </tr>
		                <?php $no++; ?>
		                @endforeach
		            </tbody>
		        </table>
		    </div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->

 </div><!-- ./col-md-12 -->
</div><!-- ./row -->


@stop


@section('styles')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{asset('/assets/backend/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/assets/backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection



@section('plugins')
 <!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="{{asset('/assets/backend/global/scripts/datatable.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/backend/global/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
@endsection



@section('scripts')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('/assets/backend/pages/scripts/table-datatables-responsive.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection