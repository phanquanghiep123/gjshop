@extends('layouts.backend')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            Add New Category
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.permission-categories.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <div class="panel-body">
            @include('backend.permission-categories.form')
        </div>
    </div>

@stop


@stop