@extends('layouts.no_banner')

@section('title') {{$category->name}} @stop
@section('meta_title') {{$category->name}} @stop
@section('meta_keywords') {{$category->meta_keywords}} @stop
@section('meta_description') {{$category->meta_descriptiom}} @stop


@section('content')

@include('_partials.frontend.admin_category_edit_link')

<?php
$quotes = $category->getRamdomQuotes();
?>

<h2 class="page-title no-margin-bottom no-margin-top">
    {{$category->name}}
</h2>
<section class="intro row">
    <div class="col-md-12">
        <p>
            {{$category->description}}
        </p>
    </div>
</section>


@if(count($articles) >= 6)
<section class="sf-choosen-category medium-margin-bottom">
    <form action="{{ request()->url() }}" id="sf-choosen-category" method="get">
        <input  data-url="{{route('articles.ajaxSearch',[$category->slug])}}" id="articles-search-btn" type="text" class="form-control category-search" name="search"
                placeholder="Search articles in {!! strtolower($category->name) !!}..."/>
    </form>
    <div style="position: relative;width: 100%;" class="clearfix">
        <div id="articles-search-result" style="display: none">
        </div>
    </div>
</section>
@endif



<section class="inner-category-page">
    <div class="list-item-content">
        <div class="row">
            <?php $total = count($articles); ?>
            @foreach($articles as $key => $article)
                <?php $link = route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$article->slug]); ?>
                <div class="col-md-6 col-sm-4 col-xs-6 article">
                    <div class="item-content">
                        <a class="img-wrapper" href="{{$link}}"><img src="{{ asset($article->list_image)}}" alt="{{$article->title}}" /></a>		
                        
                        @if($article->video_link)
                        <div class="video-holder">
                           <i class="glyphicon glyphicon-facetime-video"></i>
                        </div>
                        @endif
                        
                        <!--div class="info-title">
                            <h5>
                                <a href="{{$link}}"> {{$article->title}} </a>
                            </h5>
                        </div-->
                    </div>
                </div>

                    <div id="three-articles">
                        @if( $total >= 2 && $key == 2 || $total > 5 && $key == 2 )
                            <div class="col-sm-12 col-xs-12">          
                                <div class="normalQuotes">
                                    <div id="rotator">
                                        @foreach($quotes as $quote)
                                        <div class="textItem">{{$quote->quote}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div id="four-articles">
                        @if( $total > 3 && $key == 3 )
                            <div class="col-sm-12 col-xs-12">          
                                <div class="normalQuotes">
                                    <div id="rotator2">
                                        @foreach( $quotes as $quote)
                                        <div class="textItem">{{$quote->quote}}</div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
            @endforeach

            @if($total < 1)
                <div class="col-sm-12">
                    <h4><i>Sorry! there aren't any articles in this category. Please check back later</i></h4>
                </div>
            @endif


        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="pagination-pager">
            {{$articles->links()}}
            </div>
        </div>
    </div>
</section>



@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function () {
        ArticleSearching.bindSearch();
    });

</script>
@stop
