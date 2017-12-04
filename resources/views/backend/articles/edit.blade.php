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
    <li class="crumb-trail">Edit: {!! $article->title !!}</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">

    <a href="{!! route('gjadmin.articles.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-file-o pr5"></span> All Articles</a>

    <a href="{!! route('gjadmin.articles.show',$article->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-eye pr5"></span> Admin View </a>
            
    <?php 
        $category = $article->categories->first();
        $link = route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$article->slug]); 
    ?>

    <a href="{!! $link !!}" target="_blank" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-eye pr5"></span> View Live Article</a>


    <a href="{!! route('gjadmin.articles.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-plus pr5"></span> Add Article</a>

</div>
@stop


@section('content')
    @include('backend.articles.form', ['model' => $article])
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



