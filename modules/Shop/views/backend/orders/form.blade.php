@if (isset($model))
    {!! Former::open_vertical()->route('gjadmin.shop.orders.update',$model->id)->method('PUT') !!}
    {!! Former::populate($model) !!}
@else
    {!! Form::open(['files' => true, 'route' => 'gjadmin.shoporders.store']) !!}
@endif
	{!! Former::token() !!}

<div class="tab-block mb25">
  <ul class="nav nav-tabs tabs-border">
    <li class="active">
      <a href="#user_details" data-toggle="tab" aria-expanded="true"> <i class="glyphicon glyphicon-user"></i> Order Details</a>
    </li>

    @if(isset($model))
	    <li class="dropdown">
	      <a class="dropdown-toggle" href="#" role="menu" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-cog pl5"></i><i class="fa fa-caret-down pl5"></i>
	      </a>
	      <ul class="dropdown-menu">
	        <li>
	          <a href="#tab8_3" tabindex="-1" data-toggle="tab">Login as {{$model->f_name}} </a>
	        </li>
	        <li>
	          <a href="#tab8_4" tabindex="-1" data-toggle="tab">Delete {{$model->f_name}}</a>
	        </li>
	      </ul>
	    </li>
    @endif
  </ul>
  <div class="tab-content">

    <div id="user_details" class="tab-pane active">
    
       		<div class="col-md-8">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="glyphicon glyphicon-user"></i> Order Form
                    </span>
                  </div><!-- end .form-header section -->

                 
                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Users Account Details</span>
                      </div> <!-- .section-divider -->

						<div class="section row">
							<div class="col-md-6">
								 @if(isset($model))
									{!! Former::select('user_id','User:')->options($users,$model->user_id)->class('form-control')->disabled() !!}
							    @else 
							    	{!! Former::select('user_id','User:')->options($users)->class('form-control') !!}
							    @endif
							</div>
							<div class="col-md-6">
							  {!! Former::text('customer_phone','Contact Number:')->class('form-control') !!}
							</div>
						</div><!-- end .section row section -->


						<div class="section-divider mt10 mb40">
							<span>Delivery Details</span>
						</div> <!-- .section-divider -->

						<div class="section row">
							<div class="col-md-6">
							  {!! Former::text('customer_name','Deliver To:')->class('form-control') !!}
							</div>
	                        <div class="col-md-6">
	                          	{!! Former::text('customer_address')->class('form-control') !!}
	                        </div>
	                        @if($model->customer_state)
		                        <div class="col-md-6">
		                          {!! Former::text('customer_state')->class('form-control') !!}
		                        </div>
	                        @else
		                        <div class="col-md-6">
		                          	{!! Former::text('customer_city')->class('form-control') !!}
		                        </div>
	                        @endif
	                        <div class="col-md-6">
	                          {!! Former::text('zip_code','Zip/Post Code')->class('form-control') !!}
	                        </div>
	                        <div class="col-md-6">
	                          {!! Former::select('customer_country')->fromQuery( App\Country::all() ,'name','name' )->class('form-control') !!}
	                        </div>
	                    </div><!-- end .section row section -->


						<div class="section-divider mt10 mb40">
							<span>Delivery Note</span>
						</div> <!-- .section-divider -->


						<div class="section row">
	                        <div class="col-md-12">
	                          {!! Former::textarea('customer_note','Delivery Note:')->class('form-control summernote') !!}
	                        </div>
	                    </div><!-- end .section row section -->


	                    <div class="section-divider mt10 mb40">
							<span>Ordered Items</span>
						</div> <!-- .section-divider -->


						<div class="section row">
	                        <div class="col-md-12">
	                        	<ul>
		                        	<?php $orderItems = $order->items; ?>
	                                @if(is_array($orderItems))
										@foreach($orderItems as $item)
											<li>
												<a href="{{route('shop.products.show',['slug'=> $item['slug']] ) }}" target="_blank">
												    <label>{{@$item['quantity']}} x </label> {{@$item['name']}} ({{Modules\Shop\Helper::formatPriceWithCurrency(@$item['price'],$order->currency)}})
												</a>
											</li>
										@endforeach
									@endif
								</ul>
	                        </div>
	                    </div><!-- end .section row section -->

	                    <div class="section row">
	                        <div class="col-md-12">
	                          {!! Former::textarea('admin_note','Staff Note:')->rows(5)->class('form-control') !!}
	                        </div>
	                    </div><!-- end .section row section -->    

                    </div> <!-- end .form-body section -->


                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Order</button>
                    </div><!-- end .form-footer section -->
                  
                </div><!-- end .admin-form section -->
              </div><!-- end: .admin-form -->
             </div>


            <div class="col-md-4">
              <!-- Registration 2 -->
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="fa fa-pencil-square"></i>Orders
                    </span>
                  </div>

                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Order Details</span>
                      </div>

                      <div class="row">

                      	<div class="col-md-12">
		                    {!! Former::text('order_number')->class('form-control')->disabled() !!}
                        </div> <!-- end section -->
                      	<div class="col-md-12">
		                    {!! Former::text('token')->class('form-control')->disabled() !!}
                        </div> <!-- end section -->
                        <div class="col-md-6">
		                    {!! Former::text('currency')->class('form-control')->disabled() !!}
                        </div> <!-- end section -->
                        <div class="col-md-6">
		                    {!! Former::text('price')->class('form-control')->disabled() !!}
                        </div> <!-- end section -->
                        <div class="col-md-6">
		                    {!! Former::text('ship_fee','Shipping')->class('form-control')->disabled() !!}
                        </div> <!-- end section -->
                        <div class="col-md-6">
		                    {!! Former::text('discount','Discount')->class('form-control')->disabled() !!}
                        </div> <!-- end section -->
                        <div class="col-md-6">
		                    {!! Former::text('','Total')->forceValue( $order->price + $order->ship_fee )->class('form-control')->disabled() !!}
                        </div> <!-- end section -->
                        <div class="col-md-6">
                        	{!! Former::select('status')->class('form-control')->options(array('0' => 'Incomplete','1' => 'Paid','2' => 'Shipped','3' => 'Complete','4' => 'Cancelled','5' => 'Refunded'))->placeholder('Select Status') !!}
                        </div> <!-- end section -->
                        

                        @if($model->courier)
                        <div class="col-md-12">
                        	{!! Former::text('courier')->class('form-control')->forceValue($model->courier)->disabled() !!}
                        </div> <!-- end section -->
                        @endif

                        <div class="col-md-12">
                        	{!! Former::select('shipping_method_id','Shipping Method')->addOption('Select Option')->fromQuery( Modules\shop\Models\ShippingMethod::active()->groupBy('name')->get(),'name','id')->class('form-control') !!}
                        </div> <!-- end section -->

                        <div class="col-md-12">
                        	{!! Former::text('ship_date','Ship Date')->class('form-control') !!}
                        </div> <!-- end section -->

                        <div class="col-md-4">
                        	{!! Former::select('tracked')->class('form-control')->options(array('0' => 'No','1' => 'Yes'))->placeholder('Select') !!}
                        </div> <!-- end section -->
                        
                        <div class="col-md-8">
                        	{!! Former::text('tracking_ref','Tracking #')->class('form-control') !!}
                        </div> <!-- end section -->
                        <div class="col-md-12">
                        	{!! Former::select('send_update_email')->class('form-control')->options(array('1' => 'Send update email to customer','2' => 'Don\'t send email'))->placeholder('Select Option') !!}
                        </div> <!-- end section -->

                      </div> <!-- end .section row section -->
                      @if($model->status == '2' || $model->status == '4' || $model->status == '5')
                      <div class="row">
                      	<div class="col-md-12">
                      		<table class="table table-bordered table-hover">
                      			<thead>
                      				<tr>
                      					<th>Email</th>
                      					<th>Status</th>
                      				</tr>
                      			</thead>
                      			<tbody>
                      				@if($model->status == '2')
	                      				<tr>
	                      					<td>Shipped email</td>
	                      					<td>{{ $model->email_shipped == '0' ? 'Not Sent' : 'SENT' }}</td>
	                      				</tr>
                      				@elseif($model->status == '4')
	                      				<tr>
	                      					<td>Cancelled email</td>
	                      					<td>{{ $model->email_cancelled == '0' ? 'Not Sent' : 'SENT' }}</td>
	                      				</tr>
                      				@elseif($model->status == '5')
	                      				<tr>
	                      					<td>Refunded email</td>
	                      					<td>{{ $model->email_refunded == '0' ? 'Not Sent' : 'SENT' }}</td>
	                      				</tr>
                      				@endif
                      			</tbody>
                      		</table>
                        </div>
                      </div>
                      @endif

                    </div>

                    <div class="panel-footer">
                      <button type="submit" class="button btn-system dark">Save Order</button>
                    </div>

                </div>
              </div>
            </div>

        
    </div><!-- ***********************  User Form *********************** -->



  </div>
</div>
{!! Former::close() !!}
