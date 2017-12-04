@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Roles</li>
    <li class="crumb-trail">Edit Roles: {!! $role->name !!}</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
    <a href="{!! route('gjadmin.roles.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-users pr5"></span> All Roles</a>

    <a href="{!! route('gjadmin.roles.show',$role->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-eye pr5"></span> View Roles</a>

    <a href="#" data-toggle="modal" data-target="#addRole" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-plus pr5"></span> Add Role</a>
</div>
@stop

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Edit Role: {{$role->name}}
    </div>
    <div class="panel-body">
        @include('backend.roles.form', ['model' => $role])
    </div>
</div>



    <!-- Modal -->
<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Role</h4>
      </div>
      <div class="modal-body">
            
        {!! Former::open_vertical()->route('gjadmin.roles.store') !!}
        {!! Former::token() !!}

        {!! Former::text('name')->class('form-control')->required()->forceValue('') !!}
        
        {!! Former::textarea('description')->class('form-control')->required()->forceValue('') !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn-dark btn btn-outline" data-dismiss="modal">Close</button>        
        {!! Former::submit('Save')->class('btn btn-system') !!} 
      </div>
    </div>
  </div>
</div>
@stop