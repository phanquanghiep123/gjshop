@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Articles</li>
    <li class="crumb-trail">Add article</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
    <a href="{!! route('gjadmin.articles.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-users pr5"></span> All Articles</a>
</div>
@stop


@section('content')
   @include('backend.articles.form')
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

