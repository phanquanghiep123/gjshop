@extends('layouts.backend')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail"><a href="{!! route('gjadmin.news.index') !!}">News</a></li>
        <li class="crumb-trail"> {!! $news->title !!}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.news.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All News</a>

        <a href="{!! route('newsItem',$news->slug) !!}" target="_blank" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> View Live News</a>

        <a href="{!! route('gjadmin.news.edit',$news->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-pencil-square-o pr5"></span> Edit News</a>

        <a href="{!! route('gjadmin.news.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="glyphicon glyphicons-user_add pr5"></span> Add News</a>
    </div>
@stop


@section('content')

<div class="tab-block mb25">
  <div class="tab-content">
    <div id="page" class="tab-pane active">
     <!-- ***********************  User Form *********************** -->


            <div class="col-md-4">
              <div class="admin-form theme-dark tab-pane" id="register2" role="tabpanel">
                <div class="panel panel-dark heading-border">
                    <div class="panel-body p25">
                      <div class="section-divider mt10 mb40">
                        <span>News Details</span>
                      </div> <!-- .section-divider -->
                      <div class="row">
                        <div class="col-md-12">
                            <table class="table table-stripped">
                                <tr> <td><img src="{{ asset( $news->list_image ) }}" class="img-responsive"> </td></tr> 
                                <tr> <td><b>Title</b>: {!! $news->title !!}</td></tr> 
                                <tr><td><b>Slug</b>: {!! $news->slug !!}</td></tr> 
                                <tr><td><b>Created</b>: {!! date("D, d F Y - H:i:s",strtotime($news->created_at))  !!}</td></tr> 
                                @if($news->updated_at)
                                <tr><td><b>Updated</b>: {!! date("D, d F Y - H:i:s",strtotime($news->updated_at))  !!}</td></tr> 
                                @endif

                                <tr>
                                  <td>
                                    @if($news->date)
                                      <b>Updated</b>: {!! \Carbon\Carbon::createFromFormat('Y-m-d',$news->date)->format('d M Y') !!}
                                    @else
                                      TBA
                                    @endif
                                  </td>
                                </tr> 

                               


                                <tr><td> {!! $news->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!}</td></tr> 
                                </tr> 
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
                      <i class="fa fa-file-o"></i> {!! $news->title !!}
                    </span>
                  </div>  <!-- end .form-header section -->
                  <div class="panel-body p25">
                        <h4>Description</h4>
                        {!! $news->description !!}
                        <hr class="dashed"/>
                        <h4>Content</h4>
                        {!! $news->content !!}
                  </div> <!-- end .form-body section -->
                </div> <!-- end .admin-form section -->
              </div> <!-- end: .admin-form -->
             </div>

    </div>


  </div>
</div>


@stop