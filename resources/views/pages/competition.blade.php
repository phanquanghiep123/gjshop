@extends('layouts.no_banner')

@section('title') {{$competition->name}} @stop
@section('meta_title') {{$competition->name}} @stop
@section('meta_keywords') {{$competition->meta_keywords}} @stop
@section('meta_description') {{$competition->meta_description}} @stop

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{!! asset('/assets/frontend/images/home_icon.png') !!}" alt="back home" /></a></li>
    <li><a>{{$competition->name}}</a></li>
</ul>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title">{{$competition->name}}</h2>
        </div>
    </div>
</div>

<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $competition->description !!}
    </div>
</div>
@if($competition->end_date >= date('Y-m-d H:i:s') )
    @include('_partials.frontend.share_icons')
@endif

@endsection


@section('scripts')
<script src="https://static.addtoany.com/menu/page.js"></script>
@endsection