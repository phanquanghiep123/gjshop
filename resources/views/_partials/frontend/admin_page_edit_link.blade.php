@if($loggedUser)
	@if( $loggedUser->is('main-admin') || $loggedUser->is('admin') && can('edit-cms-page') )
		<div class="row">
		    <div class="col-md-12">
		        <a href="{!! url('nfladmin/pages/' . $page->id  . '/edit') !!}" target="_blank" class="btn btn-success large-margin-bottom pull-right">Edit &nbsp; <i class="fa fa-pencil"></i></a>
		    </div>
		</div>
	@elseif( can('edit-cms-page') )
		<div class="row">
		    <div class="col-md-12">
		        <a href="{!! url('staff/edit-page/' . $page->id  . '/edit') !!}" target="_blank" class="btn btn-success large-margin-bottom pull-right">Edit &nbsp; <i class="fa fa-pencil"></i></a>
		    </div>
		</div>
	@endif
@endif