@extends('layouts.no_banner')

@section('title') {{$brand->name}} @stop
@section('meta_title') {{$brand->name}} @stop


@section('content')

@include('_partials.frontend.admin_brand_edit_link')

<ul class="breadcrumb large-margin-bottom">
    <li><a href="{!! url('/') !!}"><img src="{!! asset('/assets/frontend/images/home_icon.png') !!}" alt="back home" /></a></li>
    <li><a href="{!! url('/brands') !!}">Brands</a></li>
    <li><a>{{$brand->name}}</a></li>
</ul>

<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title no-margin-top"> {{ $brand->name }} </h2>
        </div>
    </div>
</div>

<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $brand->content !!}
        <hr class="dashed"/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

    </div>
</div>
@endsection

