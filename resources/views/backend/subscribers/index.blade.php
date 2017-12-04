@extends('layouts.backend')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Newsletter Subscribers</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="{!! route('gjadmin.subscribers.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="glyphicon glyphicon-user pr5"></span> Add Subscriber</a>
</div>
@stop



@section('content')
<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>Newsletter Subscribers</div>
    </div>
    <div class="panel-body pn">
    	<div class="table-responsive">
	      <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
	        <thead>
	          <tr>
                <th class="text-center">Select</th>
	          	  <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Registered</th>
                <th>Actions</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($subscribers as $user)
	          <tr>
                <td class="text-center">
                        <label class="option block mn">
                          <input type="checkbox" name="mobileos" value="FR">
                          <span class="checkbox mn"></span>
                        </label>
                      </td>
	          	  <td>{!! $no !!}</td>
                <td>
                	<a href="{!! url('nfladmin/users/'.$user->id) !!}">
                    	{!! $user->signup_name  !!}
                    </a>
                </td>
                <td>
                	<a href="mailto:{!! $user->email !!}"> {!! $user->signup_email !!} </a>
                </td>
                <td>{!! $user->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!} </td>
                <td>{!! date("D, d M Y - H:i:s",strtotime( $user->created_at )) !!}</td>
                <td>
                	<div class="actions pull-right">
                        <div class="btn-group">
            						  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
            						    <span class="caret ml5"></span>
            						  </button>
            						  <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="mailto:{!! $user->signup_email !!}"><i class="fa fa-envelope"></i> Email Subscriber</a>
                            </li>
            						    <li>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.subscribers.destroy', $user->id]]) !!}                                    
                                <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Subscriber</button>
                                {!! Former::close() !!}
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



@section('js')

@endsection