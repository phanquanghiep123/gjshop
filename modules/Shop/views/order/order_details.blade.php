@extends(config('shop.layout_no_banner'))

@section('title') 
    Order Details
@stop


@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{url('/')}}"><img src="{{ asset('/assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="{{ route('viewHistory') }}">Order History</a></li>
    <li><a>Order: {{$order->order_number}}</a></li>
</ul>
@stop


@section('content')


<div class="row shop-page large-margin-top">
    <div class="col-md-12 large-margin-bottom no-print">
        <div class="page-title-article">
            <h2 class="page-title no-margin-top">
                Order Details 
                <a href="javascript:window.print()" class="btn btn-sm btn-default pull-right">
                    <i class="fa fa-print"></i>
                </a>
            </h2>
        </div>
    </div>
    <section>

        <div class="panel invoice-panel">
            
          <div class="panel-body p20" style="overflow: visible !important;" id="invoice-item">


            <div class="row" id="invoice-info">

              <div class="col-sm-{{ $order->customer_address ? '5' : '6' }}">
                <div class="panel panel-alt">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="glyphicon glyphicon-info-sign"></i> Invoice Details: </span>
                    <div class="panel-btns pull-right ml10"> </div>
                  </div>
                  <div class="panel-body">
                    <ul class="list-unstyled">
                      <li>
                        <b>Order #:</b> {!! $order->order_number !!}</li>
                      <li>
                        <b>Order Date:</b> {!! date("D, d M Y - H:i",strtotime($order->created_at)) !!}</li>
                      <li>
                        <b>Order Status:</b> <label class="label label-{{ Modules\Shop\Helper::orderStatusColour($order->status) }}">{!! Modules\Shop\Helper::orderStatus($order->status) !!}</label></li>
                      <li>
                        <b>Delivery Service:</b> {{ $order->shippingMethod ? $order->shippingMethod->name : 'N/A' }} </li>
                    </ul>
                  </div>
                </div>
              </div>

            @if( $order->customer_address )
              <div class="col-sm-4">
                <div class="panel panel-alt">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="fa fa-location-arrow"></i> Ship To:</span>
                  </div>
                  <div class="panel-body">
                    <ul class="list-unstyled">
                      <li>{!! $order->customer_name !!}</li>
                      <li>{!! $order->customer_address !!}</li>
                      <li> {!! $order->customer_city ? $order->customer_city : $order->customer_state !!}, {!! strtoupper( $order->zip_code ) !!}</li>
                      <li>{!! $order->customer_country !!}</li>
                    </ul>
                  </div>
                </div>
              </div>
            @endif

              <div class="col-sm-{{ $order->customer_address ? '3' : '6' }}">
                <div class="panel panel-alt">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="fa fa-pencil-square-o"></i> Customer Note: </span>
                  </div>
                  <div class="panel-body">
                    <address>
                      <strong>Note:</strong>
                      {!! $order->customer_note !!}
                    </address>
                  </div>
                </div>
              </div>
            </div>
            <div class="row" id="invoice-table">
              <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Item</th>
                          <th style="width: 135px;">QTY</th>
                          <th>Unit Price</th>
                          <th>Points</th>
                          <th class="text-right pr10">Sub Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $count = 1; ?>
                        @if(count( $order->items) )
                            @foreach( $order->items as $item)
                            <tr>
                              <td>
                                <b>{{ $count++ }}</b>
                              </td>
                              <td><a href="{{route('shop.products.show',['slug'=> @$item['slug']] ) }}" target="_blank">{{@$item['name']}} </a></td>
                              <td>{{@$item['quantity']}}</td>
                              <td>{{Modules\Shop\Helper::formatPriceWithCurrency( @$item['price'] ,$order->currency)}} </td>
                              <td>{{@$item['points'] * @$item['quantity'] }}</td>
                              <td class="text-right pr10">{{Modules\Shop\Helper::formatPriceWithCurrency(  @$item['price'] * @$item['quantity'], $order->currency)}}</td>
                            </tr>
                            @endforeach
                        @endif
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
            <div class="row" id="invoice-footer">
              <div class="col-md-12">
                <div class="pull-left mt20 fs15 text-primary"> <em>You earned {{$order->points_earned }} loyalty points with this order, thank you.</em></div>
                <div class="pull-right">
                    
                      <table class="table" id="invoice-summary">
                        <thead>
                          <tr>
                            <th>
                              <b>Subtotal:</b>
                            </th>
                            <th>{{Modules\Shop\Helper::formatPriceWithCurrency( $order->discount + $order->price+$order->redeem_price,$order->currency)}} </th>
                          </tr>
                        </thead>
                        <tbody>
                          @if($order->discount != '0')
                          <tr>
                            <td>
                              <b>Discount</b>
                            </td>
                            <td>-{{ Modules\Shop\Helper::formatPriceWithCurrency( $order->discount ,$order->currency)  }} </td>
                          </tr>
                          @endif
                          @if($order->redeem_price != '0')
                          <tr>
                            <td>
                              <b>Redeem</b>
                            </td>
                            <td>-{{ Modules\Shop\Helper::formatPriceWithCurrency( $order->redeem_price ,$order->currency)  }} </td>
                          </tr>
                          @endif
                          <tr>
                            <td>
                              <b>Shipping</b>
                            </td>
                            <td>{{$order->ship_fee != '0.00' ? Modules\Shop\Helper::formatPriceWithCurrency( $order->ship_fee ,$order->currency) : 'FREE' }} </td>
                          </tr>
                          <tr>
                            <td>
                              <b>Total</b>
                            </td>
                            <td>{{Modules\Shop\Helper::formatPriceWithCurrency( $order->price + $order->ship_fee ,$order->currency)}} </td>
                          </tr>
                        </tbody>
                      </table>
                    
                </div>
                <div class="clearfix"></div>
              </div>
            </div>

          </div>
        </div>

        </section>
        <!-- End: Content -->

</div>
@stop
