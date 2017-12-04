@extends('layouts.backend')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Menu
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.menus.edit', $menu->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('gjadmin.menus.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $menu->id !!}</td>
            </tr>



            <tr>
                <td><b>Created At</b></td>
                <td>{!! $menu->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop