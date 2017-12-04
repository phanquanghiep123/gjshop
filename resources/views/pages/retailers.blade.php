@extends('layouts.no_banner')

@section('title') {{$page->title}} @stop
@section('meta_title') {{$page->title}} @stop
@section('meta_keywords') {{$page->meta_keywords}} @stop
@section('meta_description') {{$page->meta_description}} @stop

<?php 
$eu_retailers = \App\Retailer::displayed()->where('region','europe')->orderBy('company','ASC')->get();  
$asia_retailers = \App\Retailer::displayed()->where('region','asia')->orderBy('company','ASC')->get();
$africa_retailers = \App\Retailer::displayed()->where('region','africa')->orderBy('company','ASC')->get();
$americas_retailers = \App\Retailer::displayed()->where('region','americas')->orderBy('company','ASC')->get();
$me_retailers = \App\Retailer::displayed()->where('region','middle_east')->orderBy('company','ASC')->get();
$aust_retailers = \App\Retailer::displayed()->where('region','australia')->orderBy('company','ASC')->get();
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

@if($page->show_top_share_icons == '1')
    @include('_partials.frontend.share_icons')
@endif

<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $page->content !!}
        <hr class="dashed"/>
    </div>
</div>
<div class="inner-article-page row">
    <div class="col-md-4">
        {!! Former::select('region','')->fromQuery( \App\Retailer::groupBy('region')->get(),'region','region')->class('form-control')->placeholder('Select Region') !!}
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="retailer-container">
            <h3> Region: <span class="green-text">Europe</span></h3>
            <ul>
                @foreach( $eu_retailers as $eu_retailer)
                    <li>
                        @if($eu_retailer->website)
                            <a href="{{ $eu_retailer->website }}" target="_blank">{{ $eu_retailer->company }}</a>
                        @else
                            {{ $eu_retailer->company }}
                        @endif
                         - ( {{ $eu_retailer->country }} )
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="retailer-container">
            <h3> Region: <span class="green-text">Americas</span></h3>
            <ul>
                @foreach( $americas_retailers as $americas_retailer)
                    <li>
                        @if($americas_retailer->website)
                            <a href="{{ $americas_retailer->website }}" target="_blank">{{ $americas_retailer->company }}</a>
                        @else
                            {{ $americas_retailer->company }}
                        @endif
                         - ( {{ $americas_retailer->country }} )
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="retailer-container">
            <h3> Region: <span class="green-text">Africa</span></h3>
            <ul>
                @foreach( $africa_retailers as $africa_retailer)
                    <li>
                        @if($africa_retailer->website)
                            <a href="{{ $africa_retailer->website }}" target="_blank">{{ $africa_retailer->company }}</a>
                        @else
                            {{ $africa_retailer->company }}
                        @endif
                         - ( {{ $africa_retailer->country }} )
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<div class="row section-split">
    <div class="col-md-4">
        <div class="retailer-container">
            <h3> Region: <span class="green-text">Australia</span></h3>
            <ul>
                @foreach( $aust_retailers as $aust_retailer)
                    <li>
                        @if($aust_retailer->website)
                            <a href="{{ $aust_retailer->website }}" target="_blank">{{ $aust_retailer->company }}</a>
                        @else
                            {{ $aust_retailer->company }}
                        @endif
                         - ( {{ $aust_retailer->country }} )
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-4">
        <div class="retailer-container">
            <h3> Region: <span class="green-text">Middle East</span></h3>
            <ul>
                @foreach( $me_retailers as $me_retailer)
                    <li>
                        @if($me_retailer->website)
                            <a href="{{ $me_retailer->website }}" target="_blank">{{ $me_retailer->company }}</a>
                        @else
                            {{ $me_retailer->company }}
                        @endif
                         - ( {{ $me_retailer->country }} )
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
</div>  
    

@if($page->show_bottom_share_icons == '1')
    @include('_partials.frontend.share_icons')
@endif

@endsection

