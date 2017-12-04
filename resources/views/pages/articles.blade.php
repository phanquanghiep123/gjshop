@extends('layouts.no_right_side')

@section('title') {{$page->title}} @stop
@section('meta_title') {{$page->title}} @stop
@section('meta_keywords') {{$page->meta_keywords}} @stop
@section('meta_description') {{$page->meta_description}} @stop

<?php 
// $tags = \App\Tag::all();  
$categories = \App\Category::all();
?>

@section('content')

@include('_partials.frontend.admin_page_edit_link')

<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title no-margin-top">{{$page->title}}</h2>
        </div>
    </div>
</div>

<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $page->content !!}
        <hr class="dashed"/>
    </div>
</div>
<div class="row">
    @foreach( $categories as $category)
        <?php 
        $artCount = $category->articles()->published()->count(); 
        ?>

        @if( $artCount > 0)
            <div class="col-md-4">
                <div class="article-container">
                    <a href="{{ route( 'articleCategory' ,$category->slug ) }}">
                        <img src="{!! asset( $category->list_image ) !!}" class="img-responsive">
                        <h3 class="article-cat-title"> {!! $category->name !!} ({{ $artCount }})</h3>
                    </a>
                </div>
            </div>
        @endif
    @endforeach
</div>

@if($page->show_bottom_share_icons == '1')
    @include('_partials.frontend.share_icons')
@endif

@endsection

