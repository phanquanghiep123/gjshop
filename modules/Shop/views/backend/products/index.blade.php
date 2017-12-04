@extends(config('shop.backend_layout'))

<?php  $amount = Modules\Shop\Models\Setting::where('key','low_inventory_amount')->value('value'); ?>

@section('breadcrumb')
  <ul class="nav nav-list nav-list-topbar pull-left">
    <li>
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li class="active">
      <a href="{!! route('gjadmin.shop.products.index') !!}">Products</a>
    </li>
    <li>
      <a href="{!! route('gjadmin.shop.orders.index') !!}">Orders</a>
    </li>
    <li>
      <a href="{!! route('gjadmin.shop.getSettings') !!}">Shop Settings</a>
    </li>
  </ul>
@stop

@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
  <a href="ecommerce_orders.html" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-plus pr5"></span> New Order</a>
  <a href="{!! route('gjadmin.shop.products.create') !!}" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-plus pr5"></span> Add Product</a>
  <a href="ecommerce_customers.html" class="btn btn-default btn-sm light fw600 ml10">
    <span class="fa fa-user pr5"></span> Add Customer</a>
</div>
@stop




@section('content')

<div class="row">
 <div class="col-md-12">
  <div class="panel panel-visible" id="spy5">
    <div class="panel-heading">
      <div class="panel-title hidden-xs">
        <span class="glyphicon glyphicon-tasks"></span>Registered Users</div>
    </div>
    
    <div class="panel-body pn">
        <div class="table-responsive">
          <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th class="text-center">Select</th>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Featured</th>
                <th>Category</th>
                <th>GBP Price</th>
                <th>USD Price</th>
                <th>Articles</th>
                <th>Satus</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>

                <?php 
                    $priceService = new Modules\Shop\Services\PriceWithSaleService();
                ?>
                @foreach ($products as $product)
                <tr>
                    <td class="text-center">
                      <label class="option block mn">
                        <input type="checkbox" name="mobileos" value="FR">
                        <span class="checkbox mn"></span>
                      </label>
                    </td>
                    <td class="text-center">{!! $index !!}</td>
                    <td><a href="{!! route('gjadmin.shop.products.show', $product->id) !!}"><img src="{!! asset($product->list_image ) !!}" class="img-thumbnail" width="50px"/></a></td>
                    <td> <a href="{!! route('gjadmin.shop.products.edit', $product->id) !!}">{!! $product->name !!}</a></td>
                    <td>
                      @if( $product->inventory > $amount )
                        {!! $product->inventory !!}
                      @else
                        <span class="text-danger">{!! $product->inventory !!}</span>
                      @endif


                    </td>
                    <td>{!! $product->is_featured == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Yes</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">No</button>'  !!}</td>
                    <td>    
                        <ul class="product-cats">
                            @foreach( $product->categories as $cat )
                            <li>{{ $cat->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="text-center">
                        <?php 
                            $priceService->setProduct($product);
                            echo $priceService->show('GBP');
                        ?>
                    </td>
                    <td class="text-center">
                        <?php 
                            echo $priceService->show();
                        ?>
                    </td>
                    <td> {!! $product->articles->count() !!} </td>
                    <td>{!! $product->status == 1 ? '<button type="button" class="btn btn-rounded btn-xs btn-success btn-block">Active</button> ' : '<button type="button" class="btn btn-rounded btn-xs btn-danger btn-block">Inactive</button>' !!}</td>
                    <td>
                        <div class="actions pull-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
                                <span class="caret ml5"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{!! route('gjadmin.shop.products.show', $product->id) !!}"> 
                                        <i class="i"></i> <i class="fa fa-eye"></i> View Product
                                    </a>
                                </li>
                                <li>
                                    <a href="{!! route('gjadmin.shop.products.edit', $product->id) !!}"> 
                                        <i class="i"></i> <i class="fa fa-pencil"></i> Edit Product
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.shop.products.destroy', $product->id]]) !!}                                    
                                    <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Product</button>
                                    {!! Form::close() !!}
                                </li>
                              </ul>
                            </div>
                        </div>
                    </td>
                  </tr>
                  <?php $index++; ?>
                  @endforeach
            </tbody>
          </table>
         </div>
    </div>
    <div class="panel-menu p12 admin-form theme-primary">
      <div class="row">
         <div class="col-md-2">
          <label class="field select">
            <select id="bulk-action" name="bulk-action">
              <option value="0">Actions</option>
              <option value="1">Active</option>
              <option value="2">Inactive</option>
              <option value="3">Featured</option>
              <option value="4">Delete</option>
            </select>
            <i class="arrow double"></i>
          </label>
        </div>
        <div class="col-md-5">
          <label class="field select">
            <select id="filter-category" name="filter-category">
              <option value="0">Filter by Category</option>
              <option value="1">Smart Phones</option>
              <option value="2">Smart Watches</option>
              <option value="3">Notebooks</option>
              <option value="4">Desktops</option>
              <option value="5">Music Players</option>
            </select>
            <i class="arrow"></i>
          </label>
        </div>
        <div class="col-md-5">
          <label class="field select">
            <select id="filter-status" name="filter-status">
              <option value="0">Filter by Status</option>
              <option value="1">Active</option>
              <option value="2">Inactive</option>
              <option value="3">Low Stock</option>
              <option value="4">Out of Stock</option>
            </select>
            <i class="arrow"></i>
          </label>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

@stop