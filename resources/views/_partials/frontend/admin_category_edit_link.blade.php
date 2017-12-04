@if($loggedUser)
	@if( $loggedUser->is('main-admin') || $loggedUser->is('admin') && can('edit-category') )
	<div class="row">
	    <div class="col-md-12">
	        <a href="{!! url('nfladmin/categories/' . $category->id  . '/edit') !!}" target="_blank" class="btn btn-success large-margin-bottom pull-right">Edit &nbsp; <i class="fa fa-pencil"></i></a>
	    </div>
	</div>
	@endif
@endif