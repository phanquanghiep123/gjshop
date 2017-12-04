@extends('layouts.backend')


@section('breadcrumb')
<ul class="page-breadcrumb">
    <li>
        <a href="{!! route('dashboard') !!}">Dashboard</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Tags</span>
    </li>
</ul>
@stop

@section('content')

<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">Tags</h3>
	</div>
	<div class="col-md-12">
		<a class="btn green sbold" data-toggle="modal" href="#draggable"> Add tag &nbsp; <i class="fa fa-tag"></i></a>
	</div>



	<div class="col-md-12">

		 <!-- BEGIN EXAMPLE TABLE PORTLET-->
		<div class="portlet light">
		    <div class="portlet-title">
		        <div class="caption">
		            <i class="icon-tag"></i> Registered Tags </div>
		        <div class="tools"> </div>
		    </div>
		    <div class="portlet-body">
		        <table class="table table-striped table-hover dt-responsive" width="100%" id="sample_3" cellspacing="0" width="100%">
		            <thead>
		                <tr>
		                	<th class="text-center">#</th>
							<th>Tag</th>
							<th>Status</th>
							<th>Created At</th>
							<th class="text-center">Action</th>
		                </tr>
		            </thead>
		            <tbody>
		            	@foreach ($tags as $tag)
		                <tr>
		                	<td class="text-center">{!! $index !!}</td>
							<td>{!! $tag->name !!}</td>
							<td>{!! $tag->status == 1 ? 'Active' : 'Inactive' !!}</td>
							<td>{!! $tag->created_at !!}</td>
		                    <td>
		                    	<div class="actions pull-right">
                                    <div class="btn-group">
                                        <a class="btn green-haze btn-outline btn-sm" href="javascript:;" data-toggle="dropdown" data-close-others="true" aria-expanded="false">
                                            <i class="fa fa-gear"></i>
                                        </a>
                                        <ul class="dropdown-menu pull-right">
                                            <li>
                                                <a href="{!! route('gjadmin.tags.show', $tag->id) !!}"> 
                                                	<i class="i"></i> <i class="fa fa-eye"></i> View Role
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{!! route('gjadmin.tags.edit', $tag->id) !!}"> 
                                                	<i class="i"></i> <i class="fa fa-pencil"></i> Edit Role
                                                </a>
                                            </li>
                                            <li class="divider"> </li>
                                            <li>
                                                <a href="javascript:;"><i class="fa fa-ban"></i> Delete Role</a>
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
		<!-- END EXAMPLE TABLE PORTLET-->

 </div><!-- ./col-md-12 -->
</div><!-- ./row -->




<div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add / Edit Tag</h4>
            </div>
            <div class="modal-body"> 

				<div class="form-horizontal">
				    @if (isset($model))
				        {!! Former::open_vertical(route('gjadmin.tags.update', $model->id ),'PUT') !!}
				        {!! Former::populate($model) !!}
				    @else
				        {!! Form::open(['files' => true, 'route' => 'gjadmin.tags.store']) !!}
				    @endif
			
					<div class="form-group">
					    {!! Form::label('name', 'Tag:', ['class' => 'col-md-2 control-label']) !!}
					    <div class="col-sm-9">
					        {!! Form::text('name', null, ['class' => 'form-control']) !!}
					    </div>
					</div>
					<div class="form-group">
					    {!! Form::label('status', 'Status:', ['class' => 'col-md-2 control-label']) !!}
					    <div class="col-sm-9">
					        {!! Former::select('status','')->options(array('1'=>'Active','2'=>'Inactive' ))->class('form-control') !!}
					    </div>
					</div>
				</div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                {!! Form::submit('Save', ['class' => 'btn green']) !!} 
            </div>
             {!! Former::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


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