@extends('layouts.backend')

@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail"><a href="{!! route('gjadmin.brands.index') !!}">Brands</a></li>
        <li class="crumb-trail"> {!! $brand->title !!}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.brands.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Brand</a>

        <a href="{!! route('viewBrand',$brand->slug) !!}" target="_blank" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> View Live Brand</a>

        <a href="{!! route('gjadmin.brands.edit',$brand->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-pencil-square-o pr5"></span> Edit Brand</a>

        <a href="{!! route('gjadmin.brands.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="glyphicon glyphicons-user_add pr5"></span> Add Brand</a>
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
                        <span>Brand Details</span>
                      </div> <!-- .section-divider -->
                      <div class="row">
                        <div class="col-md-12">
                            <table class="table table-stripped">
                                <tr> <td><img src="{{ asset( $brand->brand_logo ) }}" class="img-responsive"> </td></tr> 
                                <tr> <td><b>Brand</b>: {!! $brand->name !!}</td></tr> 
                                <tr><td><b>Slug</b>: {!! $brand->slug !!}</td></tr> 
                                <tr><td><b>Created</b>: {!! date("D, d F Y - H:i:s",strtotime($brand->created_at))  !!}</td></tr> 
                                @if($brand->updated_at)
                                <tr><td><b>Updated</b>: {!! date("D, d F Y - H:i:s",strtotime($brand->updated_at))  !!}</td></tr> 
                                @endif
                                <tr><td> {!! $brand->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!}</td></tr> 
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
                      <i class="fa fa-file-o"></i> {!! $brand->name !!}
                    </span>
                  </div>  <!-- end .form-header section -->
                  <div class="panel-body p25">
                        <h4>Description</h4>
                        {!! $brand->description !!}
                        <hr class="dashed"/>
                        <h4>Content</h4>
                        {!! $brand->content !!}
                  </div> <!-- end .form-body section -->
                </div> <!-- end .admin-form section -->
              </div> <!-- end: .admin-form -->
             </div>

    </div>


  </div>
</div>


@stop