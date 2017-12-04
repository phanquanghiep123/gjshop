@if($loggedUser)
	<div class="row">
	    <div class="col-md-12">
	    	@if( $loggedUser->is('main-admin') || $loggedUser->is('admin') && can('edit-articles') )
	        	<a href="{!! url('nfladmin/articles/' . $article->id  . '/edit') !!}" target="_blank" class="btn btn-success large-margin-bottom pull-right">Edit &nbsp; <i class="fa fa-pencil"></i></a>
	    	@endif
	    </div>
	</div>
@endif