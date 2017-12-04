@extends('layouts.no_banner')

<?php $name = $contributor->user->username  ?>
@section('title') {{$name . ' - ' . $contributor->title}} @stop
@section('meta_title') {{$name . ' - ' . $contributor->title}} @stop
@section('meta_keywords')  @stop
@section('meta_description') {{$contributor->mini_bio}} @stop

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{!! asset('/assets/frontend/images/home_icon.png') !!}" alt="back home" /></a></li>
    <li><a>{{ ucwords($name) }} </a></li>
    <li><a>{{ $contributor->title }}</a></li>
</ul>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title">{{ ucwords($name . ' - ' .$contributor->title) }}</h2>
        </div>
    </div>
</div>

<div class="inner-article-page row">
    <div class="col-md-12">
        <img style="border: 4px solid {!! $contributor->border_colour !!};" class="contributor-icon-details large-margin-top" src="{{ asset($contributor->bio_image) }}">
        {!! $contributor->bio !!}
        <hr>
        <ul class="list-inline">
            <li><i class="fa fa-facebook"></i></li>
            <li><i class="fa fa-linkedin"></i></li>
            <li><i class="fa fa-twitter"></i></li>
            <li><i class="fa fa-google"></i></li>
            <li><i class="fa fa-youtube"></i></li>
            <li><i class="fa fa-pinterest"></i></li>
        </ul>
    </div>
    
</div>
@if($contributor->end_date >= date('Y-m-d H:i:s') )
    @include('_partials.frontend.share_icons')
@endif

@endsection


@section('scripts')
<script src="https://static.addtoany.com/menu/page.js"></script>
@endsection