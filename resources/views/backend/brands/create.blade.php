@extends('layouts.backend')


@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail">Brands</li>
        <li class="crumb-trail">Add Brand</li>
    </ol>
@stop


@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.brands.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Brands</a>
    </div>
@stop


@section('content')
 @include('backend.brands.form')
@stop