@extends('layouts.backend')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Quote
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('gjadmin.quotes.edit', $quote->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('gjadmin.quotes.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $quote->id !!}</td>
            </tr>

			
            <tr>
                <td><b>Name</b></td>
                <td>{!! $quote->name !!}</td>
            </tr>			
            <tr>
                <td><b>Position</b></td>
                <td>{!! $quote->position !!}</td>
            </tr>			
            <tr>
                <td><b>Status</b></td>
                <td>{!! $quote->status !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $quote->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop