@extends(config('shop.layout_no_banner'))


@section('title')
 Order Complete
@stop

@section('content')

<div class="shop-page">
    <div class="row">
        <div class='col-sm-10 col-sm-offset-1'>
            <div class="inner-article-page row">
	            <h2>Your order has been received and will be processed shortly!</h2>
	            <p>
	            	Your order number is #{{$order}}. 
	            	You will receive an email confirming the order items and status. 
	            	Once your order has been processed and despatched we will email you 
	            	the delivery details.
	            </p>
	            
	            <p>
	            	You can check the order status at any time 

	            	@if(!$loggedUser) 

	            		by loggin into your account and choosing

	            	@else

	            		by clicking

	            	@endif
	            	
	            	"Order History" from the "User Menu". 
	            </p>
            </div>
        </div>
    </div>
</div>

@stop
