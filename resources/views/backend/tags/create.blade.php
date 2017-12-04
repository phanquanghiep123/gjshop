@extends('layouts.backend')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Tag
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.tags.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('backend.tags.form')
        </div>
    </div>

@stop