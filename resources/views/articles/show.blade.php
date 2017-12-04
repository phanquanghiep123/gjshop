@extends('layouts.no_banner')

@section('title') {{$article->title}} @stop
@section('meta_title') {{$article->title}} @stop
@section('meta_keywords') {{$article->meta_keywords}} @stop
@section('meta_description') {{$article->meta_description}} @stop

@section('og_url') {{ route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$article->slug]) }} @stop
@section('og_title') {{ $article->title }} @stop
@section('og_image') {{ asset($article->share_image) }} @stop
@section('og_description') {!! strip_tags($article->description) !!} @stop


@section('breadcrumb')
<?php $category =  $article->categories->first() ?>
<ul class="breadcrumb large-margin-bottom">
    <li><a href="{{url('/')}}"><img src="{{ asset('/assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <!-- li><a href="{{ url( 'articles' ) }}">Articles</a></li>
    <li><a href="{{ route( 'articleCategory' ,$category->slug ) }}">{{ $category->name }}</a></li-->
    <li class="hidden-xs"><a>{{$article->title}}</a></li>
</ul>
@stop

@section('content')
<section>
    <div class="page-title-article">
        <h2 class="page-title no-margin-top">
            {{$article->title}}
        </h2>
    </div>
</section>


@include('_partials.frontend.share_icons')

<div class="inner-article-page">

    @include('_partials.frontend.admin_article_edit_link')
    <div class="row medium-margin-top">
     <span class="date-posted">Posted: {{ $article->post_date }}</span>
    </div>  

    @if( $article->video_link )
    <div class="clearfix">
        <a href="#video-content-{{$article->id}}" title="{{ $article->title }}" class="video-link"> 
            <img class="img-responsive" src="{{asset('uploads/articles/videos/'.$article->video_placeholder)}}">
        </a>
    </div>
    <div style="width: 100%;display: none">
        <div id="video-content-{{$article->id}}" class="video-content">
            <?php
            $videoShowService = new App\Services\VideoShower\VideoShowerService($article->video_link);
            $videoShowService->show();
            ?>
        </div>
    </div>
    @endif
    {!! $article->content !!}
    <hr class="small-margin-bottom">
    @include('_partials.frontend.share_icons_bottom')
</div>


@if( count($article->products) )
    <div class="row">
        <div class="col-md-12">
            <div class="featuredProductSlider">
                <h5 class="featured-product-title">Related Products:</h5>
                <div class="sliders popular-products bxslider">
                    @foreach( $article->products as $p)
                        <div class="slider">
                            <div class="bg">
                                <p class="relatedProductName">
                                    {{$p->name}}
                                </p>
                                <a href="{{route('shop.products.show',['slug'=>$p->slug])}}" class="btn btn-success relatedLink"><i class="fa fa-search"></i> View</a>
                            </div>
                            <img src="{{asset($p->list_image)}}" class="img-responsive" alt="{{$p->name}}" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif 


@endsection


@section('js')
<script type="text/javascript">

    window.popularProductsSlider = null;
    
    var getPopularProductsOptions = function (isMobile, numberOfProductSlides) {

        var number;
        if (typeof numberOfProductSlides !== 'undefined' && numberOfProductSlides) {
            number = numberOfProductSlides;
        } else if (typeof isMobile === 'undefined' || !isMobile) {
            number = 4;
        } else {
            number = 2;
        }

        return {
            slideWidth: 294,
            minSlides: number,
            maxSlides: number,
            slideMargin: 15,
            pager: isMobile ? false : true
        };
    };

    $(document).ready(function () {
        var isMobileProduct = false;
        var numberOfSlider = null;
        var numberOfProductSlides = null;

        var width = $(window).width();

        if (width > 992) {
            isMobileProduct = false;
        } else if (width > 900 && width < 991 ) {
            isMobileProduct = false;
            numberOfProductSlides = 3;
        } else if (width >= 760 && width < 900 ) {
            isMobileProduct = false;
            numberOfProductSlides = 3;
        } else if (width >= 600 && width < 760 ) {
            isMobileProduct = false;
            numberOfProductSlides = 3;
        } else if (width >= 500) {
            isMobileProduct = false;
        } else {
            isMobileProduct = false;
            numberOfProductSlides = 1;
        }

        window.popularProductsSlider = $('.featuredProductSlider .bxslider').
                bxSlider(getPopularProductsOptions(isMobileProduct, numberOfProductSlides));

        window.onresize = function () {

            var numberOfSlider = null;
            var numberOfProductSlides = null;

            var width = $(window).width();

            if (width > 992) {
                isMobileProduct = false;
            } else if (width > 900 && width < 991 ) {
                isMobileProduct = false;
                numberOfProductSlides = 3;
            } else if (width >= 760 && width < 900 ) {
                isMobileProduct = true;
            } else if (width >= 600 && width < 760 ) {
                isMobileProduct = false;
                numberOfProductSlides = 3;
            } else if (width >= 500 && width < 600) {
                isMobileProduct = true;
            } else {
                isMobileProduct = true;
                numberOfProductSlides = 1;
            }

            if (window.popularProductsSlider) {
                window.popularProductsSlider.
                        reloadSlider(getPopularProductsOptions(isMobileProduct, numberOfProductSlides));
            }

        };

    });

</script>
@stop