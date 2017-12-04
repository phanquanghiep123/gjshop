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
        <li class="crumb-trail">Edit Order: {{ $order->token }}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.shop.orders.show',$order->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> View Order Invoice</a>

        <a href="{!! route('gjadmin.shop.orders.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Order</a>
    </div>
@stop


@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Order:  {{ $order->token }}
        </div>
        <div class="panel-body">
            @include('shop::backend.orders.form', ['model' => $order])
        </div>
    </div>
@stop