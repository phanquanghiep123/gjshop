@extends('layouts.auth')

@section('title') Login @stop

@section('content')
<main class="col-md-offset-4 col-md-6 col-sm-offset-3 col-sm-8 col-xs-offset-1 col-xs-10">
<div class="row large-margin-top">
  <div class="col-md-8 col-sm-8">

      <div class="admin-form theme-info" id="login">
        <div class="panel">

          {!! Former::open_vertical(url('/ajax-login'),'POST')->id('login')->onsubmit('Auth.login(this);return false;') !!}
          {!! Former::token() !!}
          <div class="panel-body">
            <div class="section">
              <h3 class="no-margin-top">LOGIN!</h3>

              <div role="alert" class="alert alert-danger signin-error" style="display: none"></div>


              {!! Former::text('email','')->classs('form-control')->placeholder('Enter Email')->required() !!}
              {!! Former::password('password','')->classs('form-control')->placeholder('Enter Password')->required() !!}
            
              <label class="switch ib switch-system mt10">
                <input type="checkbox" name="remember" id="remember" checked="">
                <label for="remember" data-on="YES" data-off="NO"></label>
                <span style="top:-12px !important;">Remember me</span>
              </label>
              <button type="submit" class="btn btn-sm pull-right btn-system">
                 Log In <i class="fa fa-btn fa-sign-in"></i>
              </button>
            </div>
          </div>
          {!! Former::close() !!}

         </div>  
      </div>

      <div class="row">
        <div class="col-md-12">
            <a href="{!! url('password/reset') !!}" class="active pull-left" title="Sign In">Forgot Your Password?</a>
            <a href="{!! route('register') !!}" class="active pull-right" title="">Register?</a>
        </div>
      </div>

  </div>
</div>
</main>
@endsection


@section('styles')

@endsection
