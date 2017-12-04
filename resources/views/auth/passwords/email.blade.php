@extends('layouts.auth')

@section('title') Reset Password @stop


@section('content')

<div class="row large-margin-top">
    <div class="col-sm-10 col-sm-offset-1 col-md-6 col-md-offset-3">
        @if(Session::has('status'))
        <div class="alert alert-success mb30" style="color: #3c763d">
            <p class="padding-left-small">
                {{ Session::get('status') }}
            </p>
        </div>
        @endif
        @if (isset($errors) && count($errors->all()) > 0)
        
        @endif
        <div class="admin-form theme-info" id="login">
            <div class="panel mb25">
                {!! Former::open_vertical(url('/password/email'),'POST') !!}
                {!! Former::token() !!}
                <div class="panel-body p25 pb15">
                    <div class="section">
                        <h3 class="no-margin-top">RESET PASSWORD</h3>
                        {!! Former::text('email','')->classs('form-control')->placeholder('Enter your login email...')->required() !!}

                        <button type="submit" class="btn btn-sm pull-right btn-system">
                            Send Reset Link <i class="fa fa-btn fa-envelope"></i> 
                        </button>

                        <a href="{!! url('login') !!}" class="btn btn-sm pull-left dark">
                            Canel <i class="fa fa-sign-in"></i>
                        </a> 
                    </div>
                </div>
                {!! Former::close() !!}
            </div>
        </div>

    </div>
</div>
@endsection
