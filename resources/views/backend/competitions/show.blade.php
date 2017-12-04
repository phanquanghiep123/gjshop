@extends('layouts.backend')

@section('heading')
<ol class="breadcrumb">
  <li><a href="{!! route('dashboard') !!}">Dashboard</a></li>
  <li><a href="{!! route('gjadmin.competitions.index') !!}">Competition</a></li>
  <li class="active">{!! $competition->name !!}</li>
</ol>
@stop

@section('content')

 <div class="panel panel-default">
        <div class="panel-heading">
             Page Details
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                
                <a href="{!! route('gjadmin.competitions.index') !!}" class="btn btn-default">All Competitions</a>
                <a href="{!! route('gjadmin.competitions.create') !!}" class="btn btn-default">Add New</a>
                <a href="{!! route('gjadmin.competitions.edit', $competition->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! url( $competition->slug) !!}" class="btn btn-default">Competition Page</a>
            </div>
        </div>
                <div class="padding-large">

                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#english" aria-controls="home" role="tab" data-toggle="tab">English</a></li>
                      </ul>

                      <!-- Tab panes -->
                      <div class="tab-content padding-top-large">
                      <div role="tabpanel" class="tab-pane fade in active" id="english">
                            <table class="table table-stripped table-bordered">
                                <tr>
                                    <td><b>Competition</b>: {!! $competition->name !!}</td>
                                    <td><b>Slug</b>: {!! $competition->slug !!}</td>
                                </tr> 
                                <tr>
                                    <td><b>Start Date</b>: {!! date("D, d F Y - H:i:s",strtotime($competition->start_date))  !!}</td>
                                    <td><b>End Date</b>: {!! date("D, d F Y - H:i:s",strtotime($competition->end_date))  !!}</td>
                                </tr>
                                <tr>
                                    <td><b>Created</b>: {!! date("D, d F Y - H:i:s",strtotime($competition->created_at))  !!}</td>
                                    <td><b>Status</b>: {!! ( $competition->status == 1 ? 'Active' : 'Inactive' ) !!}</td>
                                </tr> 
                                <tr>
                                    <td  colspan="2">
                                      <strong>Description:</strong><br>
                                      {!! $competition->description !!}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                      <b>Competion Winner:</b>
                                      {!! $competition->winner ? $competition->winner . ' <i>( ' . $competition->country .' )</i>' : 'TBA' !!}
                                    </td>
                                </tr>     
                            </table>

                      </div>
                     
                    </div>
                    <small>Updated</b>: {!! date("D, d F Y - H:i:s",strtotime($competition->updated_at))  !!}</small> 
                </div>
</div>


@stop