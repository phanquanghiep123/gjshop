@extends('layouts.backend')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="crumb-active">
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="crumb-icon">
        <span class="glyphicon glyphicon-home"></span>
    </li>
    <li class="crumb-trail">Menus</li>
    <li class="crumb-trail">Edit Menus: {!! $menu->name !!}</li>
</ol>
@stop


@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
    <a href="{!! route('gjadmin.menus.index') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-list pr5"></span> All Menus</a>

    <a href="{!! route('gjadmin.menus.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="glyphicon glyphicons-user_add pr5"></span> Add Menu</a>
</div>
@stop


@section('content')

<div class="row">
    <div class="col-md-12">
        <h3 class="page-title">Edit menu</h3>
    </div> 
</div>


<div class="panel panel-default">
    <div class="panel-heading">
        Edit Menu
    </div>
    <div class="panel-body">
        <div class="alert alert-danger" role="alert" id="page-error" style="display: none"></div>
        <div class="alert alert-success" role="alert" id="page-success" style="display: none"></div>
        <div class="form-group">
            <h5>Name</h5>
            <input type="hidden" id="menu-id" value="{{$menu->id}}" />
            <input type="text" id="menu-name" value="{{$menu->name}}" class="form-control" style="width: 200px" />
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h5>Static Page</h5>
                <ul id="page-for-sortable" class="menu-item-for-sortable sortable">
                    @foreach(App\Page::getNotInMenu($menu) as $page)
                    <li data-type="{{App\Menu::PAGE_ITEM_TYPE}}" data-id="{{$page->id}}">{{$page->title}}</li>
                    @endforeach
                </ul>

                <div class="row">
                    <div class="col-sm-1">
                        <h5>Link</h5>
                    </div>
                    <div class="col-sm-11">
                        <a  onclick="Menu.showAddLink()"> Add link</a> 
                    </div>
                </div>
                <ul id="link-for-sortable" class='menu-item-for-sortable sortable'>
                    <li data-type='{{App\Menu::LINK_ITEM_TYPE}}' data-link='/' data-title='Home'> <a>Home</a></li>
                </ul>
            </div>
            <div class="col-sm-6">
                <h5>Menu items</h5>
                <ul id="menu-item-sortable" class="menu-item-for-sortable sortable" style="min-height: 200px">
                    <?php foreach ($menu->items as $item): ?>
                        <?php if($item['type'] == App\Menu::PAGE_ITEM_TYPE) : 
                            $page = App\Page::select('id','title','slug')->where('id',$item['id'])->first();
                        ?>
                            <?php if($page): ?>
                            <li data-type="{{App\Menu::PAGE_ITEM_TYPE}}" data-id="{{$item['id']}}">{{$page->title}}</li>
                            <?php endif;?>
                        <?php endif;?>
                        <?php if($item['type'] == App\Menu::CATEGORY_ITEM_TYPE) : 
                            $cat = App\Category::select('id','name','slug')->where('id',$item['id'])->first();
                        ?>
                            <?php if($cat): ?>
                                <li data-type="{{App\Menu::CATEGORY_ITEM_TYPE}}" data-id="{{$item['id']}}">{{$cat->name}}</li>
                            <?php endif; ?> 
                        <?php endif;?>
                        <?php if($item['type'] == App\Menu::LINK_ITEM_TYPE) : ?>
                            <?php 
                                if(preg_match("/^(http:\/\/)|(https:\/\/)/", $item['link'])){
                                    $link = $item['link'];
                                }else{
                                    $link = url($item['link']);
                                }
                            ?>
                            <li data-type="{{App\Menu::LINK_ITEM_TYPE}}" data-title="{{@$item['title']}}" data-link="{{$item['link']}}">
                                <a href="{{$link}}">{!! $item['title'] !!}</a>
                            </li>
                        <?php endif;?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary" onclick="Menu.update()">Save menu</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="add-link-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add new link</h4>
            </div>
            <div class="modal-body">
                <div class="clearfix">
                    <div class="row">
                        <label for="" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="link-title" required>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px">
                        <label for="" class="col-sm-2 control-label">Link</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="link-href">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="Menu.addLink()">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop

@section('scripts')
@include('_partials.backend.menus.link')
@stop

@section('js')
    
@stop