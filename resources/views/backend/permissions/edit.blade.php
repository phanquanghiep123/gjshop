@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Permissions</li>
    <li class="crumb-trail">Edit Permission: {!! $permission->name !!}</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
    <a href="{!! route('gjadmin.permissions.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-users pr5"></span> All Permission</a>

    <a href="#" data-toggle="modal" data-target="#addPermission" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-plus pr5"></span> Add Permission</a>
</div>
@stop



@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Edit Permission: {{$permission->name}}
    </div>
    <div class="panel-body">
        @include('backend.permissions.form', ['model' => $permission])
    </div>
</div>



<div class="modal fade" id="addPermission" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Permission Category</h4>
      </div>
      <div class="modal-body">
            
        {!! Former::open_vertical(route('gjadmin.permissions.store'),'POST') !!}
        {!! Former::token() !!}

        {!! Former::text('name')->class('form-control')->required()->forceValue('') !!}
                
        {!! Former::select('category_id','Category:')->fromQuery( App\PermissionCategory::active()->get(), 'name','id')->class('form-control')->required() !!}

        {!! Former::textarea('description','Description:')->class('form-control')->forceValue('')->required()->rows(3) !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn-dark btn btn-outline" data-dismiss="modal">Close</button>        
        {!! Former::submit('Save')->class('btn btn-system') !!} 
      </div>
    </div>
  </div>
</div>



@stop