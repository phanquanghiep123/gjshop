@extends('layouts.backend')


@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail">Email Templates</li>
        <li class="crumb-trail">Edit Email Template: {!! $email->name !!}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.email-templates.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Email Templates</a>

        <a href="{!! route('gjadmin.email-templates.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="glyphicon glyphicons-user_add pr5"></span> Add Email Template</a>
    </div>
@stop


@section('content')
    @include('backend.email-templates.form', ['model' => $email])
@stop