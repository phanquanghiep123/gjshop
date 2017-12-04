@extends(config('shop.backend_layout'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail">Orders</li>
        <li class="crumb-trail">View Order: {{ $order->token }}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.shop.orders.edit',$order->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-pencil-square-o pr5"></span> Edit Order</a>

        <a href="{!! route('gjadmin.shop.orders.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Order</a>
    </div>
@stop


@section('content')
<!-- Begin: Content -->
<section id="content" class="">

<div class="panel invoice-panel">
  <div class="panel-heading">
    <span class="panel-title">
      <span class="glyphicon glyphicon-print"></span> Printable Invoice</span>
    <div class="panel-header-menu pull-right mr10">
      <a href="javascript:window.print()" class="btn btn-xs btn-default btn-gradient mr5">
        <i class="fa fa-print fs13"></i>
      </a>
      <div class="btn-group">
        <button type="button" class="btn btn-xs btn-default btn-gradient dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-cog"></span>
        </button>
        <ul class="dropdown-menu checkbox-persist pull-right text-left" role="menu">
          <li>
            <a href="{!! route('gjadmin.shop.orders.edit', $order->id) !!}">
              <i class="fa fa-pencil"></i> Edit Order </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="panel-body p20" style="overflow: visible !important;" id="invoice-item">

    <div class="row mb30">
      <div class="col-md-4">
        <div class="pull-left">
          <h1 class="lh10 mt10"> INVOICE </h1>
          <h5 class="mn"> Created: {!! date("l, d F Y - H:i",strtotime($order->created_at)) !!} </h5>
          <h5 class="mn"> Status:
            <b class="text-success">{!! Modules\Shop\Helper::orderStatus($order->status) !!}</b>
          </h5>
        </div>
      </div>
      <div class="col-md-4">
        <div class="pull-right text-right">
          <h2 class="invoice-logo-text hidden lh10">Nurtured For Living</h2>
        </div>
      </div>
      <div class="col-md-4"> 
        <img src="{{ asset('assets/frontend/images/logo.jpg') }}" class="img-responsive center-block mw200 hidden-xs" alt="Nurtured For Living"> 
      </div>
    </div>
    <div class="row" id="invoice-info">
      
      <div class="col-md-4">
        <div class="panel panel-alt">
          <div class="panel-heading">
            <span class="panel-title">
              <i class="fa fa-location-arrow"></i> Ship To: {!! $order->customer_name !!}</span>
          </div>
          <div class="panel-body">
            <ul class="list-unstyled">
              <li>{!! $order->customer_address !!}</li>
              <li> {!! $order->customer_city ? $order->customer_city : $order->customer_state !!}, {!! $order->zip_code !!}</li>
              <li>{!! $order->customer_country !!}</li>
              <li>T:{!! $order->customer_phone !!}</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-alt">
          <div class="panel-heading">
            <span class="panel-title">
              <i class="fa fa-info"></i> Invoice Details: </span>
            <div class="panel-btns pull-right ml10"> </div>
          </div>
          <div class="panel-body">
            <ul class="list-unstyled">
              <li>
                <b>Order #:</b> {!! $order->order_number !!}</li>
              <li>
                <b>Order Date:</b> {!! date("l, d F Y - H:i",strtotime($order->created_at)) !!}</li>
              <li>
                <b>Order Status:</b> {!! Modules\Shop\Helper::orderStatus($order->status) !!}</li>
              <li>
                <b>Delivery Service:</b> {{ $order->shippingMethod ? $order->shippingMethod->name : 'tba'}} </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-4">
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
                  <th>Rate</th>
                  <th class="text-right pr10">Price</th>
                </tr>
              </thead>
              <tbody>
                <?php $count = 1; ?>
                @foreach( $order->items as $item)
                <tr>
                  <td>
                    <b>{{ $count++ }}</b>
                  </td>
                  <td><a href="{{route('shop.products.show',['slug'=> @$item['slug']] ) }}" target="_blank">{{@$item['name']}} </a></td>
                  <td>{{@$item['quantity']}}</td>
                  <td>{{Modules\Shop\Helper::formatPriceWithCurrency( @$item['price'] ,$order->currency)}} </td>
                  <td class="text-right pr10">{{Modules\Shop\Helper::formatPriceWithCurrency(  @$item['price'] * @$item['quantity'], $order->currency)}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </div>
    <div class="row" id="invoice-footer">
      <div class="col-md-12">
        <div class="pull-left mt20 fs15 text-primary"> <em>Thank you for your order.</em></div>
        <div class="pull-right">
            
              <table class="table" id="invoice-summary">
                <thead>
                  <tr>
                    <th>
                      <b>Sub Total:</b>
                    </th>
                    <th>{{Modules\Shop\Helper::formatPriceWithCurrency( $order->price,$order->currency)}} </th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <b>Shipping</b>
                    </td>
                    <td>{{ Modules\Shop\Helper::formatPriceWithCurrency( $order->ship_fee ,$order->currency) }} </td>
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


@stop
