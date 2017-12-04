@extends('layouts.auth')

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
                {!! Former::open_vertical(url('/password/reset'),'POST') !!}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="panel-body p25 pb15">
                    <div>
                        <h3 class="no-margin-top">RESET PASSWORD</h3>
                        {!! Former::text('email','Email:')->classs('form-control')->placeholder('Enter your login email...')->required() !!}

                        {!! Former::password('password','Password:')->classs('form-control')->placeholder('Enter new password')->required() !!}

                        {!! Former::password('password_confirmation','password Confirmation:')->classs('form-control')->placeholder('Confirm Password')->required() !!}

                        <button type="submit" class="btn-success btn btn-sm">
                            Reset Password
                        </button>
                 
                    </div>
                </div>
                {!! Former::close() !!}
            </div>
        </div>

    </div>
</div>
@endsection
