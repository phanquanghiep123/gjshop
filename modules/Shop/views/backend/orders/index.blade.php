@extends(config('shop.backend_layout'))


@section('breadcrumb')
  <ul class="nav nav-list nav-list-topbar pull-left">
    <li>
      <a href="{!! route('dashboard') !!}">Dashboard</a>
    </li>
    <li>
      <a href="{!! route('gjadmin.shop.products.index') !!}">Products</a>
    </li>
    <li class="active">
      <a href="{!! route('gjadmin.shop.orders.index') !!}">Orders</a>
    </li>
    <li>
      <a href="{!! route('gjadmin.shop.getSettings') !!}">Shop Settings</a>
    </li>
  </ul>
@stop

@section('breadcrumb_right')
<div class="topbar-right hidden-xs hidden-sm">
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
                <th class="text-center">#</th>
                <th>User</th>
                <th>Order Number</th>
                <th>Price</th>
                <th>Voucher</th>
                <th>Ship fee</th>
                <th>Status</th>
                <th>Email</th>
                <th>Created At</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>

                @foreach ($orders as $order)
                <tr>
                     <td class="text-center">
                        <label class="option block mn">
                          <input type="checkbox" name="mobileos" value="FR">
                          <span class="checkbox mn"></span>
                        </label>
                      </td>
                    <td class="text-center">{!! $index !!}</td>
                    <td>
                        <?php
                        if ($order->user_id) {
                            $user = \App\User::find($order->user_id);
                            if ($user) {
                                echo "<a href=' ". route('gjadmin.users.show',$user->id)  ." '>" .$user->fullname . "</a>";
                            } else {
                                echo "Guest";
                            }
                        } else {
                            echo "Guest";
                        }
                        ?>

                        @if($order->admin_note)
                          <i class="fa fa-comment text-danger" data-toggle="popover" data-placement="top" title="Admin Note" data-content='{{ $order->admin_note }}'></i>
                        @endif
                    </td>
                    <td>{!! $order->order_number !!}</td>
                    <td>{{Modules\Shop\Helper::formatPriceWithCurrency( $order->price,$order->currency)}} </td>
                    <td class="text-center"> {!! $order->voucher ? $order->voucher : 'N/A' !!} </td>
                    <td>{{Modules\Shop\Helper::formatPriceWithCurrency( $order->ship_fee,$order->currency)}} </td>
                    <td>
                        <?php
                            $orderStatus = Modules\Shop\Helper::orderStatus($order->status);
                            $orderStatusColour = Modules\Shop\Helper::orderStatusColour($order->status);
                        ?>
                        <button type="button" class="btn btn-rounded btn-xs btn-{{ $orderStatusColour }} btn-block">{{  $orderStatus }}</button> 
                    </td>
                    <td>{!! $order->email_shipped == 1 ? 'SENT' : 'tba' !!}</td>
                    <td>{!! date("D, d M Y - H:i:s",strtotime( $order->created_at )) !!}</td>

                    <td>
                        <div class="actions pull-right">
                            <div class="btn-group">
                              <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
                                <span class="caret ml5"></span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{!! route('gjadmin.shop.orders.show', $order->id) !!}"> 
                                        <i class="i"></i> <i class="fa fa-eye"></i> View Order
                                    </a>
                                </li>
                                <li>
                                    <a href="{!! route('gjadmin.shop.orders.edit', $order->id) !!}"> 
                                        <i class="i"></i> <i class="fa fa-pencil"></i> Edit Order
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['gjadmin.shop.orders.destroy', $order->id]]) !!}                                    
                                    <button type="submit" class="actionButton"><i class="glyphicon glyphicon-trash"></i> Delete Order</button>
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