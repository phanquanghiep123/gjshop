@extends('layouts.no_right_side')

@section('title') Add a referral @stop

@section('css')
.admin-form .panel {
    margin-bottom: 20px;
    background-color: #ffffff;
    border: 1px dashed #DDD;
    padding: 10px 25px 30px;
}
.alternate-details h3 {
    border-bottom: 1px dashed #ddd;
    margin-bottom: 20px;
    margin-top:15px;
}
.form-group .required {
    color: #333333; 
    font-size: 14px; 
}
@stop


@section('breadcrumb')

<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{{asset('assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="{{ route('my_account')}}">Account</a></li>
    <li><a href="#">Add a referral</a></li>
</ul>
@stop



@section('content')
<div class="row large-margin-top">
    <div class="col-md-3">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-dark bold uppercase">Welcome {!! $loggedUser->username ? $loggedUser->username : $loggedUser->f_name !!} </span>
                </div>
            </div>
            <div class="portlet-body">
                @include('_partials.frontend.side_quick_links')
            </div>
        </div> 
    </div>
    <div class="col-md-9">
        @include('_partials.backend.notifications')
        <div>
            <h4 class="account-page-title no-margin-top large-margin-bottom"> <i class="fa fa-ticket"></i> Add a referral</h4>
            <p>
                It is important that your referrals are correctly attached to your account. In order to avoid duplicate user entries
                we verify the referral's email or contact number to check if they already exist. If an entry is found you will recieve a warning message
                asking you to add a different candidate. When your referral places their first order we run further checks with the new data.
                If the user has more than one account, the first account and referrer will be kept and additional accounts will be deleted. 
                Please ensure that you have read our <a href="{{ url('terms-and-conditions#many-hands') }}">Terms & Conditions</a>. 
            </p>
            <hr class="dashed"/>

        </div>
        <div class="admin-form alternate-details">
            <div class="panel" style="padding: 10px 25px 15px !important;">
   
                <div class="section">

                    {!! Former::vertical_open()
                    ->route('save_referral')
                    ->onsubmit('ReferralForm.Add(this);return false;')->id('addReferral')
                    !!}

                    {!! Former::token() !!}

                    <div class="form-group large-margin-top">
                        <div class="col-md-6">
                            {!! Former::text('f_name','First Name:')->class('form-control')->placeholder('REQUIRED')->required() !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::text('l_name','Last Name:')->class('form-control')->placeholder('REQUIRED')->required() !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Former::text('email','Email:')->class('form-control')->placeholder('REQUIRED')->required() !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::text('mobile','Contact Number:')->class('form-control')->placeholder('OPTIONAL') !!}
                        </div>
                    </div>
                    
 
                    <div class="form-group">
                        <div class="col-md-12">
                            <hr class="dashed"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Former::textarea('personal_message','Personal Message:')->class('form-control')->placeholder('OPTIONAL')->rows(5)->inlineHelp('This will be included at the top of our welcome email.') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <hr class="dashed"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Former::submit('Add Referral')->class('btn btn-success') !!}
                        </div>
                    </div>
                    <br clear="all"/>
                    {!! Former::close() !!}
                </div>                     
            </div>
        </div>
    </div>

        
</div>
@endsection