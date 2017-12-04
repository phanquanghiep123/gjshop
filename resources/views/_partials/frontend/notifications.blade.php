@if(!Session::has('noPageAlert'))

@if (isset($errors) && count($errors->all()) > 0)


<div class="alert alert-danger alert-dismissable mb30">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	<h3 class="mt5">Whoops!</h3>
	<p>There were some problems with your submission.</p>
	<p class="padding-left-small">
	@foreach ($errors->all() as $error)
	<li>{{ $error }}</li> 
	@endforeach
	</p>
	<br clear="all"/>
</div>
@elseif (!is_null(Session::get('status_error')))
<div class="alert alert-danger alert-dismissable mb30">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	<h3 class="mt5">Sorry Error!</h3>
	@if (is_array(Session::get('status_error')))
		<ul class="no-margin">
		@foreach (Session::get('status_error') as $error)
			<li>{{ $error }}</li>
		@endforeach
		</ul>
	@else
		{{ Session::get('status_error') }}
	@endif
</div>
@endif

@if (!is_null(Session::get('status_success')))
<div class="alert alert-system alert-dismissable mb30">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
  <h3 class="mt5">Success!</h3>
	@if (is_array(Session::get('status_success')))
		<ul>
			@foreach (Session::get('status_success') as $success)
				<li>{{ $success }}</li>
			@endforeach
		</ul>
	@else
		{{ Session::get('status_success') }}
	@endif
  
</div>
@endif


@if(Session::has('message'))
 <div class="alert alert-system alert-dismissable mb30">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	<h3 class="mt5">SUCCESS!</h3>
	<p class="padding-left-small">
		{{ Session::get('message') }}
	</p>
	<br clear="all"/>
</div>

@endif


@if(Session::has('status'))
 <div class="alert alert-warning alert-dismissable mb30">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
	<h3 class="mt5"><i class="fa fa-warning"></i> ATTENTION!</h3>
	<p class="padding-left-small">
		{{ Session::get('status') }}
	</p>
	<br clear="all"/>
</div>
@endif

@endif