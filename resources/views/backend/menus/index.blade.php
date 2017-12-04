@extends('layouts.backend')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Menus</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="{!! route('gjadmin.menus.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-file-o pr5"></span> Add Menu</a>
</div>
@stop


@section('content')



<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>Menus
      </div>
    </div>
    <div class="panel-body pn">
    	<div class="table-responsive">
	      <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
	        <thead>
	          <tr>
                <th class="text-center">#</th>
				<th>Menu </th>
				<th>Added</th>
				<th class="text-right">Action</th>
	          </tr>
	        </thead>
	        <tbody>
            	@foreach ($menus as $menu)
				<tr>
					<td class="text-center">{!! $index !!}</td>
					<td>{!! $menu->name !!}</td>
					<td>{!! $menu->created_at ? \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$menu->created_at)->format('D, d M Y') : "" !!}</td>
                   	<td>
	                	<div class="actions pull-right">
	                        <div class="btn-group">
	          						  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
	          						    <span class="caret ml5"></span>
	          						  </button>
      						  <ul class="dropdown-menu" role="menu">
								<li>
									<a href="{!! route('gjadmin.menus.show',$menu->id) !!}"> 
										<i class="i"></i> <i class="fa fa-eye"></i> View Menu
									</a>
								</li>
								<li>
									<a href="{!! route('gjadmin.menus.edit',$menu->id) !!}"> 
										<i class="i"></i> <i class="fa fa-pencil"></i> Edit Menu
									</a>
								</li>
								<li class="divider"></li>
								<li>
									{!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.menus.destroy', $menu->id]]) !!}                                    
									<button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Menu</button>
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