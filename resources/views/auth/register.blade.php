@extends('layouts.auth')

@section('title') Register @stop

@section('content')
<main class="col-md-offset-3 col-md-6 col-sm-offset-1 col-sm-8 col-xs-offset-1 col-xs-10">
<div class="row large-margin-top" id="register-page">
    <div class="col-md-12 col-sm-12">

      <div class="admin-form theme-primary" id="">
        <div class="panel">
            {!! Former::open_vertical()->route('register')->method('POST')->id('register') !!}
            {!! Former::token() !!}
            <div class="panel-body p25 pb15">
              <h3 class="no-margin-top">REGISTER</h3>

              <div class="row">
                <div class="col-sm-6">
                  {!! Former::text('f_name','')->classs('form-control')->placeholder('First Name...')->required() !!}
                </div>

                <div class="col-sm-6">
                  {!! Former::text('l_name','')->classs('form-control')->placeholder('Last Name...')->required() !!}
                </div>

                <div class="col-md-12">
                  {!! Former::text('email_address','')->classs('form-control')->placeholder('Enter Email...')->required() !!}
                </div>
              </div>                     

              <hr class="alt small-margin-top">

              <div class="row">
                 <div class="col-md-6">
                  {!! Former::password('register_password','')->classs('form-control')->placeholder('Password')->required() !!}
                 </div>
                 <div class="col-md-6">
                  {!! Former::password('confirm_password','')->classs('form-control')->placeholder('Confirm Password')->required() !!}
                 </div>
              </div>
              <hr class="alt small-margin-top">
              <div class="col-md-6 col-md-offset-4">
                  <button type="submit" class="btn btn-md btn-success spin">
                      <i class="icon-user"></i> Register
                  </button>
              </div>
            </div>

          {!! Former::close() !!}
        </div>

        <div class="row">
          <div class="col-md-12">
              <a href="{!! url('login') !!}" class="active" title="">Login?</a>
          </div>
        </div>
      </div>



    </div>
</div>
</main>
@endsection


@section('styles')

@endsection
