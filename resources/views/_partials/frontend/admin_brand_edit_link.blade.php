@if($loggedUser)
	@if( $loggedUser->is('main-admin') || $loggedUser->is('admin') && can('edit-brand') )
		<div class="row">
		    <div class="col-md-12">
		        <a href="{!! route('gjadmin.brands.edit',$brand->id) !!}" target="_blank" class="btn btn-success large-margin-bottom pull-right">Edit &nbsp; <i class="fa fa-pencil"></i></a>
		    </div>
		</div>
	@endif
@endif