@extends('layouts.backend')


@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail">News</li>
        <li class="crumb-trail">Edit News: {!! $news->title !!}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.news.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All News</a>

        <a href="{!! route('gjadmin.news.show',$news->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> Admin View </a>

        @if($news->status == \App\News::ACTIVE && $news->post_date < date('Y-m-d') )
        <a href="{!! route('viewBrand',$news->slug) !!}" target="_blank" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> View Live News</a>
        @endif

        <a href="{!! route('gjadmin.news.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-plus pr5"></span> Add News</a>
    </div>
@stop


@section('content')
    @include('backend.news.form', ['model' => $news])
@stop

@section('scripts')
    <script type="text/javascript">
        $('#status').change(function () {
            var status = $(this).val();
            console.log(typeof status);
            if (status === "1") {
                $('#post-date-wrapper').show();
            } else {
                $('#post-date-wrapper').val("");
                $('#post-date-wrapper').hide();
            }
        });
    </script>
@endsection