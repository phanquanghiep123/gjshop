@extends('layouts.backend')

@section('breadcrumb')
<ul class="nav nav-list nav-list-topbar pull-left">
    <li class="active">
      <a href="{!! route('site_settings') !!}">Site Settings</a>
    </li>
    <li>
      <a href="{!! route('gjadmin.shop.getSettings') !!}">Shop Settings</a>
    </li>
</ul>
@stop


@section('breadcrumb_right')

@stop





@section('pageTitle')
<h3 class="page-title"> Nurtured For Living
    <small>Site settings</small>
</h3>
@endsection





@section('content')

{!! Former::open_horizontal()->route('update_settings') !!}
{!! Former::token() !!}
{!! Former::populate($settings) !!}
<!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

<!-- begin: .tray-center -->
<div class="tray tray-center">

  <div class="mw1000 center-block">

    <!-- Store Owner Details -->
    <div class="panel panel-warning panel-border top mt20 mb35">
      <div class="panel-heading">
        <span class="panel-title">General Information</span>
      </div>
      <div class="panel-body bg-light dark">
        <div class="admin-form">
          <div class="section row mb10">
            <label for="account-email" class="field-label col-md-3 text-center">Homepage Keywords:</label>
            <div class="col-md-9">
              {!! Former::textarea('meta_keywords','Homepage Keywords')->rows(2)->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="account-email" class="field-label col-md-3 text-center">Homepage Description:</label>
            <div class="col-md-9">
              {!! Former::textarea('meta_description')->rows(2)->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="account-email" class="field-label col-md-3 text-center">Copyright:</label>
            <div class="col-md-9">
              {!! Former::text('copyright')->class('form-control')->label(false) !!}
            </div>
          </div>
        </div>
      </div>
    </div>




                            

    <!-- Store Information -->
    <div class="panel panel-info panel-border top mb35">
      <div class="panel-heading">
        <span class="panel-title">Social Links</span>
      </div>
      <div class="panel-body bg-light dark">
        <div class="admin-form">

          <div class="section row mb10">
            <label for="business-name" class="field-label col-md-3 text-center">Facebook:</label>
            <div class="col-md-9">
                {!! Former::text('facebook')->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="business-phone" class="field-label col-md-3 text-center">Youtube:</label>
            <div class="col-md-9">
                {!! Former::text('youtube')->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="business-name" class="field-label col-md-3 text-center">Twitter:</label>
            <div class="col-md-9">
                {!! Former::text('twitter')->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="business-phone" class="field-label col-md-3 text-center">Pinterest:</label>
            <div class="col-md-9">
                {!! Former::text('pinterest')->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="business-name" class="field-label col-md-3 text-center">Instagram:</label>
            <div class="col-md-9">
                {!! Former::text('instagram')->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="business-phone" class="field-label col-md-3 text-center">Google:</label>
            <div class="col-md-9">
                {!! Former::text('google')->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="business-phone" class="field-label col-md-3 text-center">Show Socials:</label>
            <div class="col-md-9">
                {!! Former::select('show_socials')->options(array('1'=>'Visible','2'=>'Hidden'))->class('form-control')->label(false) !!}
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Store Settings -->
    <div class="panel panel-primary panel-border top mb35">
      <div class="panel-heading">
        <span class="panel-title">Contact Information</span>
      </div>
      <div class="panel-body bg-light dark">
        <div class="admin-form">

          <div class="section row mb10">
            <label for="names" class="field-label col-md-3 text-center">UK Contact Number:</label>
            <div class="col-md-9">
                {!! Former::text('uk_number','')->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="names" class="field-label col-md-3 text-center">Us Contact Number:</label>
            <div class="col-md-9">
                {!! Former::text('us_number','')->class('form-control')->label(false) !!}
            </div>
          </div>
          <div class="section row mb10">
            <label for="names" class="field-label col-md-3 text-center">UK Address:</label>
            <div class="col-md-9">
                {!! Former::textarea('address')->class('form-control summernote')->label(false) !!}
            </div>
          </div>
          {!! Former::submit('Update Settings')->class('btn btn-md btn-system') !!}
 
                                
                                

        </div>
      </div>
    </div>


    
  </div>

</div><!-- end: .tray-center -->


</section><!-- End: Content -->
{!! Former::close() !!}

@endsection


@section('styles')

@endsection

@section('plugins')

@endsection

@section('scripts')

@endsection