@extends('layouts.no_banner')

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
@if($page->show_top_share_icons == '1')
@include('_partials.frontend.share_icons')
@endif

<div class="inner-article-page row" id="privacy">
    <div class="col-md-11">
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