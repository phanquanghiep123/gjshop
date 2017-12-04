@extends('layouts.backend')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Role
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.roles.edit', $role->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('gjadmin.roles.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $role->id !!}</td>
            </tr>

			
            <tr>
                <td><b>Name</b></td>
                <td>{!! $role->name !!}</td>
            </tr>			
            <tr>
                <td><b>Slug</b></td>
                <td>{!! $role->slug !!}</td>
            </tr>			
            <tr>
                <td><b>Description</b></td>
                <td>{!! $role->description !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $role->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop