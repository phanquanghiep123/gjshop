@if($loggedUser)
	@if( $loggedUser->is('main-admin') || $loggedUser->is('admin') && can('edit-products') )
		<div class="row">
		    <div class="col-md-12">
		        <a href="{!! url('nfladmin/shop/products/' . $product->id  . '/edit') !!}" target="_blank" class="btn btn-sm btn-success large-margin-bottom">Edit &nbsp; <i class="fa fa-pencil"></i></a>
		    </div>
		</div>
	@endif
@endif