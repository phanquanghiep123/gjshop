@extends('layouts.customer_service')

@section('title') {{$page->title}} @stop
@section('meta_title') {{$page->title}} @stop
@section('meta_keywords') {{$page->meta_keywords}} @stop
@section('meta_description') {{$page->meta_description}} @stop

@section('content')

@include('_partials.frontend.admin_page_edit_link')

<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title no-margin-top">{{$page->title}}</h2>
        </div>
    </div>
</div>

<div class="inner-article-page row" id="privacy">
    <div class="col-md-11">
    	<?php
    		$ukFreeShipping = Modules\Shop\Models\Setting::where('key', 'uk_free_shipping')->first();
    		$str = $page->content;
            $content =  str_replace('{free_shipping}','£'.$ukFreeShipping->value,$str);
    	?>
        {!! $content !!}

        <small>Last updated: {!! date('l, d F Y',strtotime($page->updated_at)) !!}</small>
    </div>
</div>

@endsection


@section('scripts')
<script src="https://static.addtoany.com/menu/page.js"></script>
@endsection