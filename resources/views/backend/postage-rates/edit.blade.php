@extends('layouts.backend')


@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Postage Rates</li>
    <li class="crumb-trail">Edit Postage Rate: {!! $postageRate->name !!}</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
    <a href="{!! route('gjadmin.postage-rates.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-users pr5"></span> All Postage Rate</a>

    <a href="{!! route('gjadmin.postage-rates.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-plus pr5"></span> Add Postage Rate</a>
</div>
@stop


@section('content')
    @include('backend.postage-rates.form', ['model' => $postageRate])
@stop
