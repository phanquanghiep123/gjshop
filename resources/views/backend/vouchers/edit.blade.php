@extends('layouts.backend')


@section('breadcrumb')
    <ol class="breadcrumb">
        <li class="crumb-active">
          <a href="{!! route('dashboard') !!}">Dashboard</a>
        </li>
        <li class="crumb-icon">
            <span class="glyphicon glyphicon-home"></span>
        </li>
        <li class="crumb-trail">Reward Vouchers</li>
        <li class="crumb-trail">Edit Voucher: {!! $voucher->title !!}</li>
    </ol>
@stop

@section('breadcrumb_right')
    <div class="topbar-right hidden-xs hidden-sm">
        <a href="{!! route('gjadmin.vouchers.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-users pr5"></span> All Vouchers</a>

        <a href="{!! route('gjadmin.vouchers.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
        <span class="fa fa-plus pr5"></span> Add Voucher</a>
    </div>
@stop


@section('content')
    @include('backend.vouchers.form', ['model' => $voucher])
@stop
