@extends('layouts.no_banner')

@section('title') {{$page->title}} @stop
@section('meta_title') {{$page->title}} @stop
@section('meta_keywords') {{$page->meta_keywords}} @stop
@section('meta_description') {{$page->meta_description}} @stop

<?php $news = \App\News::active()->orderBy('post_date','DESC')->paginate(4); ?>

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

<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $page->content !!}
        <hr class="dashed no-margin-bottom">
    </div>
</div>

    @foreach( $news as $item)
        @if(count($news) > 0)
        <div class="news-container">
            <div class="row">
                <div class="col-md-4">
                    <img src="{!! $item->list_image !!}" class="img-responsive">
                </div>
                <div class="col-md-8">
                    <a href="{{ route('newsItem',$item->slug ) }}" class="newsTitle">{!! $item->title !!}</a><br/>
                    <!--img src="{!! $item->list_image !!}" class="img-responsive"-->
                    <p class="date">{!! date('l, d F Y',strtotime( $item->post_date )) !!}</p>
                    <div class="news-intro">
                        {!! $item->description !!}
                    </div>
                </div>
            </div>
        </div>
        @else

        @endif
    @endforeach

<div class="row">
    <div class="col-md-12">
        {{ $news->links() }}
    </div>
</div>



@if($page->show_bottom_share_icons == '1')
    @include('_partials.frontend.share_icons')
@endif

@endsection

