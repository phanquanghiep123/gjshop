@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Roles</li>
</ol>
@stop

@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="#" data-toggle="modal" data-target="#addRole" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-plus pr5"></span> Add Role</a>
</div>
@stop

@section('content')

<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>Registered Roles</div>
    </div>
    
    <div class="panel-body pn">
        <div class="table-responsive">
          <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="text-center">Select</th>
                <th class="text-center">#</th>
				<th>Name</th>
				<th>Slug</th>
				<th>Description</th>
				<th>Created At</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr>

					<td class="text-center">
						<label class="option block mn">
						  <input type="checkbox" name="mobileos" value="FR">
						  <span class="checkbox mn"></span>
						</label>
					</td>
					<td class="text-center">{!! $index !!}</td>
					<td><a href="{!! route('gjadmin.roles.edit',$role->id) !!}">{!! $role->name !!}</a></td>
					<td>{!! $role->slug !!}</td>
					<td>{!! $role->description !!}</td>
					<td>{!! $role->created_at !!}</td>
                    <td>
                        <div class="actions pull-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
                                <span class="caret ml5"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{!! route('gjadmin.roles.show', $role->id) !!}"> 
                                        <i class="i"></i> <i class="fa fa-eye"></i> View Role
                                    </a>
                                </li>
                                <li>
                                    <a href="{!! route('gjadmin.roles.edit', $role->id) !!}"> 
                                        <i class="i"></i> <i class="fa fa-pencil"></i> Edit Role
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.roles.destroy', $role->id]]) !!}                                    
                                    <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Role</button>
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
    <div class="panel-menu p12 admin-form theme-primary">
      <div class="row">
         <div class="col-md-2">
          <label class="field select">
            <select id="bulk-action" name="bulk-action">
              <option value="0">Actions</option>
              <option value="1">Active</option>
              <option value="2">Inactive</option>
              <option value="3">Featured</option>
              <option value="4">Delete</option>
            </select>
            <i class="arrow double"></i>
          </label>
        </div>
        <div class="col-md-5">
          <label class="field select">
            <select id="filter-category" name="filter-category">
              <option value="0">Filter by Category</option>
              <option value="1">Smart Phones</option>
              <option value="2">Smart Watches</option>
              <option value="3">Notebooks</option>
              <option value="4">Desktops</option>
              <option value="5">Music Players</option>
            </select>
            <i class="arrow"></i>
          </label>
        </div>
        <div class="col-md-5">
          <label class="field select">
            <select id="filter-status" name="filter-status">
              <option value="0">Filter by Status</option>
              <option value="1">Active</option>
              <option value="2">Inactive</option>
              <option value="3">Low Stock</option>
              <option value="4">Out of Stock</option>
            </select>
            <i class="arrow"></i>
          </label>
        </div>
      </div>
    </div>
  </div>
</div>

</div>



<!-- Modal -->
<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Role</h4>
      </div>
      <div class="modal-body">
			
		{!! Former::open_vertical()->route('gjadmin.roles.store') !!}
		{!! Former::token() !!}

        {!! Former::text('name')->class('form-control')->required() !!}
        
        {!! Former::textarea('description')->class('form-control')->required() !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn-dark btn btn-outline" data-dismiss="modal">Close</button>        
        {!! Former::submit('Save')->class('btn btn-system') !!} 
      </div>
    </div>
  </div>
</div>

@stop



@section('plugins')

@endsection



@section('scripts')

@endsection