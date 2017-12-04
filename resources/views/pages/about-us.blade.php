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

<div class="inner-article-page row">
    <div class="col-md-11">
        {!! $page->content !!}
    </div>
</div>

<div class="inner-article-page row large-margin-top">
	@foreach( App\Contributor::active()->get() as $contributor)
	    <div class="col-md-3">
	    	<a href="{!! route('contributorDetails',$contributor->slug) !!}">
		    	<img style="border: 4px solid {!! $contributor->border_colour !!};" class="contributor-icon" src="{{ asset($contributor->bio_image) }}">
		        <h4 class="contributor-title">{!! $contributor->title !!}</h4>
	        </a>
	    </div>
    @endforeach
</div>


@if($page->show_bottom_share_icons == '1')
@include('_partials.frontend.share_icons')
@endif

@endsection


@section('scripts')
<script src="https://static.addtoany.com/menu/page.js"></script>
@endsection