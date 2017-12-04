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
        <li class="crumb-trail">Add Order</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.shop.orders.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Order</a>

        <a href="{!! route('gjadmin.shop.orders.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="glyphicon glyphicons-user_add pr5"></span> Add Order</a>
    </div>
@stop


@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Add Order
        </div>
        <div class="panel-body">
            @include('shop::backend.orders.form')
        </div>
    </div>
@stop