@extends(config('shop.backend_layout'))


@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail">Product Categories</li>
        <li class="crumb-trail">Edit Product Category: {!! $productcategory->name !!}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.shop.productcategories.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Product Categories</a>

        <a href="{!! route('gjadmin.shop.productcategories.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-plus pr5"></span> Add Product Category</a>
    </div>
@stop


@section('content')
    @include('shop::backend.productcategories.form', ['model' => $productcategory])
@stop