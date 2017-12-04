@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Faq Categories</li>
</ol>
@stop

@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="#" data-toggle="modal" data-target="#addCategory" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-plus pr5"></span> Add Category</a>

  <a href="{{ route('gjadmin.faqs.create') }}" class="btn btn-default btn-sm light fw600 ml10">
      <span class="fa fa-plus pr5"></span> Add Faq</a>
</div>
@stop

@section('content')

<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>Registered Faq Categories</div>
    </div>
    
    <div class="panel-body pn">
        <div class="table-responsive">
          <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="text-center">Select</th>
                <th class="text-center">#</th>
        				<th>Name</th>
                <th class="text-center">Order</th>
        				<th class="text-center">Status</th>
                <th class="text-center">Displayed</th>
                <th class="text-center">Active Questions</th>
        				<th class="text-center">Created at</th>
        				<th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <?php $activeQuestionCount = $category->questions()->active()->count(); ?>
	                <tr>
          						<td class="text-center">
          							<label class="option block mn">
          							  <input type="checkbox" name="mobileos" value="FR">
          							  <span class="checkbox mn"></span>
          							</label>
          						</td>
          						<td class="text-center">{!! $index !!}</td>
          						<td><a href="{!! route('gjadmin.faq-categories.edit', $category->id) !!}">{!! $category->name !!}</a></td>
                      <td>{!! $category->order !!}</td>
          	          <td>{!! $category->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!} </td>
                      <td>{!! $activeQuestionCount > 0 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Visible</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Hidden</button>' !!} </td>
          						<td class="text-center">{!! $activeQuestionCount !!}</td>
                      <td  class="text-center">{!! date('D, d M Y - H:i:s',strtotime(  $category->created_at )) !!}</td>
	                    <td>
	                        <div class="actions pull-right">
	                            <div class="btn-group">
	                              <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
	                                <span class="caret ml5"></span>
	                              </button>
	                              <ul class="dropdown-menu" role="menu">
	                                <li>
	                                    <a href="{!! route('gjadmin.faq-categories.edit', $category->id) !!}"> 
	                                        <i class="i"></i> <i class="fa fa-pencil"></i> Edit Category
	                                    </a>
	                                </li>
	                                <li class="divider"></li>
	                                <li>
	                                    {!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.faq-categories.destroy', $category->id]]) !!}                                    
	                                    <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Category</button>
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
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Faq Category</h4>
      </div>
      <div class="modal-body">
			
        {!! Former::open_vertical()->route('gjadmin.faq-categories.store') !!}
        {!! Former::token() !!}

        {!! Former::text('name')->class('form-control')->required() !!}

        {!! Former::number('order')->class('form-control') !!}
        
        {!! Former::select('status')->options(array('1'=>'Acive','2'=>'Inactive'))->class('form-control')->required() !!}

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