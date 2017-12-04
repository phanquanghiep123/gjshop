@extends('layouts.backend')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Users</li>
    <li class="crumb-trail">Edit User: {!! $user->fullname() !!}</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
    <a href="{!! route('gjadmin.users.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-users pr5"></span> All Users</a>

    <a href="{!! route('gjadmin.users.show',$user->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-eye pr5"></span> View User</a>

    <a href="{!! route('gjadmin.users.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="glyphicon glyphicons-user_add pr5"></span> Add User</a>
</div>
@stop


@section('content')
    @include('backend.users.form', ['model' => $user])
@stop