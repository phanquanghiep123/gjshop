@extends('layouts.backend')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Permission
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.permissions.edit', $permission->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('gjadmin.permissions.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $permission->id !!}</td>
            </tr>

			
            <tr>
                <td><b>Name</b></td>
                <td>{!! $permission->name !!}</td>
            </tr>			
            <tr>
                <td><b>Slug</b></td>
                <td>{!! $permission->slug !!}</td>
            </tr>			
            <tr>
                <td><b>Description</b></td>
                <td>{!! $permission->description !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $permission->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop