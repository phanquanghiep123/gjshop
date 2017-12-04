@extends('layouts.backend')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail">CMS Pages</li>
        <li class="crumb-trail"> {!! $cmspage->title !!}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.pages.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Pages</a>

        <a href="{!! url($cmspage->slug) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> View Live Page</a>

        <a href="{!! route('gjadmin.pages.edit',$cmspage->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-pencil-square-o pr5"></span> Edit Page</a>

        <a href="{!! route('gjadmin.pages.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="glyphicon glyphicons-user_add pr5"></span> Add Page</a>
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
                        <span>Page Details</span>
                      </div> <!-- .section-divider -->
                      <div class="row">
                        <div class="col-md-12">
                            <table class="table table-stripped">
                                <tr><td><b>Title</b>: {!! $cmspage->title !!}</td></tr>
                                <tr><td><b>Slug</b>: {!! $cmspage->slug !!}</td></tr>
                                <tr>
                                    <td  colspan="2">
                                      <strong>Meta data:</strong> <br/>
                                      <strong>Keywords:</strong> {!! $cmspage->meta_keywords !!}<br/>
                                      <strong>Description:</strong> {!! $cmspage->meta_description !!}
                                    </td>
                                </tr>    
                                <tr><td><b>Created At</b>: {!! date("D, d F Y - H:i:s",strtotime($cmspage->created_at))  !!}</td> </tr> 
                                <tr><td><b>Updated At</b>: {!! date("D, d F Y - H:i:s",strtotime($cmspage->updated_at))  !!}</td> </tr> 
                                <tr><td> {!! $cmspage->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!}</td></tr> 
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
                      <i class="fa fa-file-o"></i> {!! $cmspage->title !!}
                    </span>
                  </div>  <!-- end .form-header section -->
                  <div class="panel-body p25">
                        {!! $cmspage->content !!}
                  </div> <!-- end .form-body section -->
                </div> <!-- end .admin-form section -->
              </div> <!-- end: .admin-form -->
             </div>


            

    </div>


  </div>
</div>


@stop