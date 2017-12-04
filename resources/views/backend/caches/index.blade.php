@extends('layouts.backend')


@section('breadcrumb')
<ul class="page-breadcrumb">
    <li>
        <a href="{!! route('dashboard') !!}">Dashboard</a>
        <i class="fa fa-circle"></i>
    </li>
    <li>
        <span>Caching Management</span>
    </li>
</ul>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">All Caches</h3>
    </div>
    <div class="col-md-12">
        <h4>Menus</h4>
        @foreach(App\Menu::select('name')->get() as $menu)
        <div class="col-sm-3">
            Name : <label>{{$menu->name}}</label><br/>
            <?php
                $cache = App\Engine\Menu::get($menu->name);
            ?>
            <i> Size : {{size_of_var($cache)}} </i><br/>
            {!! Former::open()->route('gjadmin.caches.refreshMenu')->method('POST') !!}
            <input type="hidden" name="name" value="{{$menu->name}}" />
            <button type="submit" class='btn btn-primary'>Refresh</button>
            {!! Former::close() !!}
        </div>
        @endforeach
    </div>
</div><!-- ./row -->



@stop


@section('styles')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="{{asset('/assets/backend/global/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('/assets/backend/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
@endsection



@section('plugins')

@endsection



@section('scripts')
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('/assets/backend/pages/scripts/table-datatables-responsive.min.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
@endsection