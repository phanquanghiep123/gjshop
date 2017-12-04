@extends(config('shop.backend_layout'))

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail">Products</li>
        <li class="crumb-trail">Edit Product: {{$product->name}}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.shop.products.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Products</a>

        <a href="{!! route('gjadmin.shop.products.show',$product->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> View Product</a>

        @if($product->status == 1)
            <a href="{!! route('shop.products.show',['slug'=>$product->slug]) !!}" target="_blank" class="btn btn-default btn-sm light fw600 ml10">
            <span class="fa fa-eye pr5"></span> View Live Product</a>
        @endif
        <a href="{!! route('gjadmin.shop.products.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="glyphicon glyphicons-user_add pr5"></span> Add Product</a>

    </div>
@stop


@section('content')
    @include('shop::backend.products.form', ['model' => $product])
@stop