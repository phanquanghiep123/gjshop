@extends(config('media.layout'))

@section('breadcrumb')
<ul class="page-breadcrumb">
    <li>
        <a href="{!! route('dashboard') !!}">Dashboard</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <a href="{!! route('gjadmin.articles.index') !!}">Articles</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Add Article</span>
    </li>
</ul>
@stop

@section('content')
<div class="media-toolbar">
    <div class="row">
        <div class="col-sm-3">
            <select class="form-control">
                <option value="all">All medias items</option>
                <option value="image">Images</option>
                <option value="video">Video</option>
                <option value="audio">Audio</option>
            </select>
        </div>
        <div class="col-sm-2">    
            <select class="form-control">
                <option value="all">All dates</option>
                <option value="audio">Audio</option>
            </select>
        </div>
        <div class="col-sm-5 pull-right">
            <input type="text" class="form-control" placeholder="Search" />
        </div>
    </div>
</div>
@stop
