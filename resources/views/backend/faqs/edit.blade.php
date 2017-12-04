@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Faqs</li>
    <li class="crumb-trail">Edit Faq: {!! $faq->question !!}</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
    <a href="{!! route('gjadmin.faqs.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-users pr5"></span> All Faqs</a>

    <a href="{!! route('gjadmin.faqs.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-plus pr5"></span> Add Faq</a>
</div>
@stop



@section('content')
  @include('backend.faqs.form', ['model' => $faq])


<!-- Modal -->
<div class="modal fade" id="addFaq" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Faqs</h4>
      </div>
      <div class="modal-body">
      
      {!! Former::open_vertical(route('gjadmin.faqs.store'),'POST') !!}
      {!! Former::token() !!}

      {!! Former::textarea('question')->class('form-control')->rows(3)->required() !!}

      {!! Former::textarea('answer')->class('form-control')->rows(6)->required() !!}
            
      {!! Former::select('faq_category_id','Category:')->fromQuery( App\FaqCategory::active()->get(), 'name','id')->class('form-control')->required() !!}

      {!! Former::select('status')->options(array('1'=>'Acive','2'=>'Inactive'))->class('form-control')->required() !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn-dark btn btn-outline" data-dismiss="modal">Close</button>        
        {!! Former::submit('Save')->class('btn btn-system') !!} 
      </div>
    </div>
  </div>
</div>



@stop