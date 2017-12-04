@extends('layouts.backend')


@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail">Retailers</li>
        <li class="crumb-trail">Edit Retailer: {!! $retailer->company !!}</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.retailers.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Retailers</a>

        <a href="{!! route('gjadmin.retailers.show',$retailer->id) !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> Admin View </a>

        <a href="{!! url('retailers') !!}" target="_blank" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-eye pr5"></span> View Live Retailers</a>

        <a href="{!! route('gjadmin.retailers.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-plus pr5"></span> Add Retailer</a>
    </div>
@stop


@section('content')
    @include('backend.retailers.form', ['model' => $retailer])
@stop