@extends('layouts.no_banner')

@section('title') {{$news->title}} @stop
@section('meta_title') {{$news->title}} @stop


@section('content')

@include('_partials.frontend.admin_news_edit_link')

<ul class="breadcrumb large-margin-bottom">
    <li><a href="{!! url('/') !!}"><img src="{!! asset('/assets/frontend/images/home_icon.png') !!}" alt="back home" /></a></li>
    <li><a href="{!! url('/news') !!}">News</a></li>
    <li><a>{{$news->title}}</a></li>
</ul>


<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title no-margin-top"> {{ $news->title }} </h2>
        </div>
    </div>
</div>

<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $news->content !!}
        <hr class="dashed"/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">

    </div>
</div>
@endsection

