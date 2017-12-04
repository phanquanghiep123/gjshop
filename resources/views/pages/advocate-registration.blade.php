@extends('layouts.no_banner')

@section('title') {{$page->title}} @stop
@section('meta_title') {{$page->title}} @stop
@section('meta_keywords') {{$page->meta_keywords}} @stop
@section('meta_description') {{$page->meta_description}} @stop

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

@section('content')

@include('_partials.frontend.admin_page_edit_link')

<div class="row">
    <div class="col-md-12">
        <div class="page-title-article">
            <h2 class="page-title no-margin-top">{{$page->title}}</h2>
        </div>
    </div>
</div>
<div class="inner-article-page row">
    <div class="col-md-12">
        {!! $page->content !!}
    </div>
</div>
<div class="row large-margin-top">
    


    <div class="col-md-12">
        <div class="admin-form alternate-details">
            <div class="panel" style="padding: 10px 25px 15px !important;">
   
                <div class="section">

                    {!! Former::vertical_open()
                    ->route('contact_us')
                    ->onsubmit('ContactForm.Contact(this);return false;')->id('contactUs')
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
                            {!! Former::text('username','Username:')->class('form-control')->placeholder('REQUIRED')->required()->inlineHelp('This will be your referrer code') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6">
                            {!! Former::password('password','Password:')->class('form-control')->placeholder('REQUIRED')->required() !!}
                        </div>
                        <div class="col-md-6">
                            {!! Former::password('confirm_password','Confirm Password:')->class('form-control')->placeholder('REQUIRED')->required() !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <hr class="dashed"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Former::text('address','Door / House Name and street:')->class('form-control')->placeholder('REQUIRED') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4">
                            {!! Former::text('zip_code','Post/Zip code:')->class('form-control')->placeholder('REQUIRED') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Former::text('country','Country:')->class('form-control')->placeholder('REQUIRED') !!}
                        </div>
                        <div class="col-md-4">
                            {!! Former::text('city','City/State:')->class('form-control')->placeholder('REQUIRED') !!}
                        </div>                        
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Former::text('referrer','How did you hear about this opportunity:')->class('form-control')->placeholder('OPTIONAL') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <hr class="dashed"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Former::submit('Register')->class('btn btn-success') !!}
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