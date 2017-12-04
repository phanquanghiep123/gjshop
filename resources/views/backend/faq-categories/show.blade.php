@extends('layouts.backend')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Category
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.faq-categories.edit', $category->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('gjadmin.faq-categories.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $category->id !!}</td>
            </tr>

			
            <tr>
                <td><b>Name</b></td>
                <td>{!! $category->name !!}</td>
            </tr>			
            <tr>
                <td><b>Position</b></td>
                <td>{!! $category->position !!}</td>
            </tr>			
            <tr>
                <td><b>Status</b></td>
                <td>{!! $category->status !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $category->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop