@extends('layouts.no_banner')

@section('title') {{$page->title}} @stop
@section('meta_title') {{$page->title}} @stop
@section('meta_keywords') {{$page->meta_keywords}} @stop
@section('meta_description') {{$page->meta_description}} @stop

<?php $brands = \App\Brand::active()->paginate(3);  ?>

@section('content')

@include('_partials.frontend.admin_page_edit_link')

<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title no-margin-top"> {{ $page->title }} </h2>
        </div>
    </div>
</div>

@if($page->show_top_share_icons == '1')
    @include('_partials.frontend.share_icons')
@endif

<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $page->content !!}
        <hr class="dashed"/>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
    @if(count($brands) > 0)
        @foreach( $brands as $brand)
            <div class="row">
                <div class="col-md-5 brand-image">
                    <div class="brand-container">
                        <a href="{{ route('viewBrand',$brand->slug) }}">
                            <img src="{{ asset( $brand->brand_logo ) }}" class="img-responsive">
                        </a>
                    </div>
                </div>
                <div class="col-md-7 brand-text">
                    <div class="brand-container">
                        <h3><a href="{{ route('viewBrand',$brand->slug) }}"> {{ $brand->name }} </a></h3>
                        <p> {!! neat_trim( $brand->description, 370 ) !!} </p>
                        
                    </div>
                </div>
                <div class="col-md-12">
                    <hr class="dashed"/>
                </div>
            </div>
        @endforeach
    @else


    @endif
    </div>
</div>
<div class="row">
    {{ $brands->links() }}
</div>


@if($page->show_bottom_share_icons == '1')
    @include('_partials.frontend.share_icons')
@endif

@endsection

