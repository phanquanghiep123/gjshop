@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Cms Pages</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="{!! route('gjadmin.pages.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-file-o pr5"></span> Add Page</a>
</div>
@stop






@section('content')

<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>CMS Pages
      </div>
    </div>
    <div class="panel-body pn">
    	<div class="table-responsive">
	      <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
	        <thead>
	          <tr>
                <th class="text-center">Select</th>
            	  <th>#</th>
        				<th>English </th>
        				<th>Slug</th>
        				<th>Status</th>
        				<th>Added</th>
                <th>Actions</th>
	          </tr>
	        </thead>
	        <tbody>
	          @foreach ($cmspages as $page)
	          <tr>
      				<td class="text-center">
        				<label class="option block mn">
        				  <input type="checkbox" name="mobileos" value="FR">
        				  <span class="checkbox mn"></span>
        				</label>
      				</td>
	          	<td class="text-center">{!! $no !!}</td>
      				<td><a href="{!! route('gjadmin.pages.edit',$page->id) !!}"> {!! $page->title !!}</a></td>
      				<td>{!! $page->slug !!}</td>
              <td>{!! $page->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!} </td>
				      <td>{!! \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$page->created_at)->format('M,d Y') !!}</td>
                <td>
                	<div class="actions pull-right">
                        <div class="btn-group">
          						  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
          						    <span class="caret ml5"></span>
          						  </button>
          						  <ul class="dropdown-menu" role="menu">
            						    <li>
              								<a href="{!! route('gjadmin.pages.show',$page->id) !!}"> 
              									<i class="i"></i> <i class="fa fa-eye"></i> View Page
              								</a>
            						    </li>
                            <li>
                              <a href="{!! route('gjadmin.pages.edit',$page->id) !!}"> 
                                <i class="i"></i> <i class="fa fa-pencil"></i> Edit Page
                              </a>
                            </li>
            						    <li class="divider"></li>
            						    <li>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.pages.destroy', $page->id]]) !!}                                    
                                <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Page</button>
                                {!! Form::close() !!}
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






@stop


@section('styles')


@endsection



@section('plugins')


@endsection



@section('scripts')


@endsection