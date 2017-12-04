@extends('layouts.customer_service')

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
    


    <div class="col-md-7">
        <div class="admin-form alternate-details">
            <div class="panel" style="padding: 10px 25px 15px !important;">
                <div class="col-md-12">
                    <h3>Email Us</h3>
                </div>
                <div class="section">

                    {!! Former::vertical_open()
                    ->route('contact_us')
                    ->onsubmit('ContactForm.Contact(this);return false;')->id('contactUs')
                    !!}

                    {!! Former::token() !!}

                    <div class="form-group large-margin-top">
                        <div class="col-md-12">
                            {!! Former::text('name','Name:')->class('form-control')->required() !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Former::text('email','Email:')->class('form-control')->required() !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Former::select('department','Department: ')->options(array('info'=>'Information', 'sales'=>'Sales','wholesale'=>'Wholesale'))->class('form-control') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Former::textarea('message','Message:')->rows(7)->class('form-control')->required() !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            {!! Former::submit('Send Message' ,'')->class('btn btn-success') !!}
                        </div>
                    </div>
                    <br clear="all"/>
                    {!! Former::close() !!}
                </div>                     
            </div>
        </div>
    </div>


    <div class="col-md-4">
        <div class="admin-form alternate-details">
            <div class="panel">
              <div class="">
                <h3>Alternate Contact Details</h3>

                <div class="section">
                    <h4>Write To Us:</h4>
                    <h4 class="no-margin-bottom">Nurtured For Living LTD</h4>
                    {!! $settings->address !!}
                    
                    <hr class="alt short">
                    
                    @if( $settings->uk_number || $settings->us_number )
                        <h4>Call Us:</h4>
                        <p class="no-margin-bottom">
                            @if($settings->uk_number)
                                UK: {!! $settings->uk_number !!}<br/>
                                Monday - Friday: 9am - 5pm
                            @endif
                            @if($settings->us_number)
                                US: {!! $settings->us_number !!}
                            @endif
                        </p>
                    @endif
                </div> 
                 <hr class="alt short">
                {!! $page->extra_info !!}
              </div>    
            </div>
        </div>
    </div>

        
</div>
@endsection