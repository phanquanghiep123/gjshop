@extends(config('shop.backend_layout'))

<?php $setting = \App\SiteSetting::first(); ?>


@section('breadcrumb')
<ul class="nav nav-list nav-list-topbar pull-left">
    <li>
      <a href="{!! route('site_settings') !!}">Site Settings</a>
    </li>
    <li class="active">
      <a href="{!! route('gjadmin.shop.getSettings') !!}">Shop Settings</a>
    </li>
</ul>
@stop


@section('breadcrumb_right')

@stop




@section('content')

{!! Former::open_horizontal()->route('gjadmin.shop.saveSettings') !!}
{!! Former::token() !!}
{!! Former::populate($settings) !!}
<!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">
    <div class="tray tray-center">
      <div class="mw1000 center-block">
        <div class="panel panel-warning panel-border top mt20 mb35">
          <div class="panel-heading">
            <span class="panel-title">General Shop Settings</span>
          </div>
          <div class="panel-body bg-light dark">
            <div class="admin-form">
              <div class="section row mb10">
                <label for="account-email" class="field-label col-md-3 text-center">Multiple Shop Locations:</label>
                <div class="col-md-9">
                  {!! Former::checkbox('is_multiple_shop_locations')->label(false) !!}
                </div>
              </div>
              {!! Former::submit('Update Settings')->class('btn btn-md btn-system pull-right') !!}
            </div>
          </div>
        </div>
      </div>
    </div><!-- end: .tray-center -->
</section><!-- End: Content -->
{!! Former::close() !!}

@stop
