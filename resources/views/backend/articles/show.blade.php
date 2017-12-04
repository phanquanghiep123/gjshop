@extends('layouts.backend')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail"><a href="{!! route('gjadmin.articles.index') !!}">Articles</a></li>
        <li class="crumb-trail"> {!! $article->title !!}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.articles.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-file-o pr5"></span> All Articles</a>
                
        <?php 
            $category = $article->categories->first();
            $link = route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$article->slug]); 
        ?>

        <a href="{!! $link !!}" target="_blank" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> View Live Article</a>

        <a href="{!! route('gjadmin.articles.edit',$article->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-pencil-square-o pr5"></span> Edit Article</a>

        <a href="{!! route('gjadmin.articles.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-plus pr5"></span> Add Article</a>
    </div>
@stop


@section('content')

<div class="tab-block mb25">
  <div class="tab-content">
    <div id="page" class="tab-pane active">


            <div class="col-md-4">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>Article Details</span>
                      </div> <!-- .section-divider -->
                      <div class="row">
                        <div class="col-md-12">
                            <table class="table table-stripped">
                                <tr> <td colspan="2"><img src="{{ asset( $article->list_image ) }}" class="img-responsive"> </td></tr> 
                                <tr><td colspan="2"><b>Title</b>: {!! $article->title !!}</td></tr>
                                <tr><td colspan="2"><b>Slug</b>: {!! $article->slug !!}</td></tr>
                                @if($article->video_link)
                                    <tr><td colspan="2"><b>Video Link</b>: {!! $article->video_link !!}</td></tr>
                                @endif
                                
                                <tr>
                                    <td>
                                      <strong>Categories:</strong> <br/>
                                      <ul class="padding-left-large">
                                        @foreach( $article->categories as $artCat)
                                            <li> {{ $artCat->name }} </li>
                                        @endforeach
                                      </ul> 
                                    </td>
                                    <td>
                                      <strong>Tags:</strong> <br/>
                                      <ul class="padding-left-large">
                                        @foreach( $article->tags as $tag)
                                            <li> {{ $tag->name }} </li>
                                        @endforeach
                                      </ul> 
                                    </td>
                                </tr>  

                                <tr>
                                    <td colspan="2">
                                      <strong>Meta data:</strong> <br/>
                                      <strong>Keywords:</strong> {!! $article->meta_keywords !!}<br/>
                                      <strong>Description:</strong> {!! $article->meta_description !!}
                                    </td>
                                </tr>
                                <tr><td colspan="2"><b>Created At</b>: {!! date("D, d F Y - H:i:s",strtotime($article->created_at))  !!}</td> </tr> 
                                @if($article->updated_at)
                                    <tr><td colspan="2"><b>Updated At</b>: {!! date("D, d F Y - H:i:s",strtotime($article->updated_at))  !!}</td> </tr> 
                                @endif  
                                <tr><td colspan="2"> {!! $article->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!}</td></tr> 
                            </table>
                        </div> <!-- end section -->
                      </div> <!-- end .section row section -->
                    </div> <!-- end .form-body section -->
                </div> <!-- end .admin-form section -->
              </div> <!-- end: .admin-form -->
            </div>


            <div class="col-md-8">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                  <div class="panel-heading">
                    <span class="panel-title">
                      <i class="fa fa-file-o"></i> {!! $article->title !!}
                    </span>
                  </div>  <!-- end .form-header section -->
                  <div class="panel-body p25">
                        <h4>Intro Text</h4>
                        {!! $article->description !!}
                        <hr class="dashed"/>
                        <h4>Main Article</h4>
                        {!! $article->content !!}
                  </div> <!-- end .form-body section -->
                </div> <!-- end .admin-form section -->
              </div> <!-- end: .admin-form -->
             </div>


            

    </div>


  </div>
</div>

@stop