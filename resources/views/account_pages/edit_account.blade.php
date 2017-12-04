@extends('layouts.no_right_side')

@section('title') Edit Account @stop


@section('breadcrumb')

<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{{asset('assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="{{ route('my_account')}}">Account</a></li>
    <li><a href="#">Edit Account</a></li>

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
            <h4 class="account-page-title no-margin-top large-margin-bottom"> <i class="icon-user"></i> Edit Account</h4>
        </div>

        

        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject font-dark bold uppercase"><i class="icon-user"></i> Personal Details</span>
                </div>
            </div>
            <div class="portlet-body">
                {!! Former::vertical_open()
                ->route('updateProfile')
                ->onsubmit('updateProfile(this);return false;')
                ->enctype("multipart/form-data")
                ->id('editProfileForm')
                !!}
                {!! Former::populate($loggedUser) !!}
                {!! Former::token() !!}
                {!! Former::hidden('id',$loggedUser->id) !!}

                <div class="row">
                    <div class="col-sm-6">
                        {!! Former::text('f_name','First Name') !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Former::text('l_name','Last Name') !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Former::text('email','email')->inlineHelp('Login / invoice email') !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Former::text('mobile','Contact Number')->inlineHelp('Only used in emergency cases') !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Former::text('username','Username') !!}
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-9">
                                {!! Former::file('avatar','Photo')
                                ->class('form-control')
                                ->id('avatar-user')
                                ->accept('image/*')
                                ->onchange("ImageSelector.loadPreview(this)")
                                ->dataPreviewId('avatar-user-preview')
                                !!}
                            </div>
                            <div class="col-sm-3">
                                <div id="avatar-user-preview">
                                    @if( $loggedUser->avatar)
                                    <img src="{{url($loggedUser->avatar)}}" class="thumbnail" alt="avatar" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div> 

                </div>
                <hr class="dashed"/>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Former::password('password') !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Former::password('confirm_password') !!}
                    </div>
                </div>
                <hr class="dashed"/>
                <div class="row"> 
                    <div class="col-sm-12">
                        {!! Former::submit('Update Profile')->class('btn btn-success pull-right') !!}
                    </div>
                </div>
                {!! Former::close() !!}
                <hr class="dashed"/>
                <div class="portlet-title">
                    <div class="caption medium-margin-bottom">
                        <span class="caption-subject font-dark bold uppercase"><i class="icon-home"></i> Addresses</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        
                        @include('_partials.frontend.customerAddresses')

                    </div>
                </div>
                
            </div>
        </div> 
        
    </div>

</div>
@endsection

@section('js')

@endsection
