@extends('layouts.no_banner')

@section('title') {{$page->title}} @stop
@section('meta_title') {{$page->title}} @stop
@section('meta_keywords') {{$page->meta_keywords}} @stop
@section('meta_description') {{$page->meta_description}} @stop

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{!! asset('/assets/frontend/images/home_icon.png') !!}" alt="back home" /></a></li>
    <li><a>{{$page->title}}</a></li>
</ul>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title">{{$page->title}}</h2>
        </div>
    </div>
</div>


<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $page->content !!}
    </div>
</div>
@if($page->show_bottom_share_icons == '1')
@include('_partials.frontend.share_icons')
@endif
@endsection


@section('scripts')
<script src="https://static.addtoany.com/menu/page.js"></script>
@endsection