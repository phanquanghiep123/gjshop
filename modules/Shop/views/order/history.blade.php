@extends('layouts.no_right_side')

@section('title') 
    Order History
@stop



@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{{asset('assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="{{ route('my_account')}}">Account</a></li>
    <li><a href="#">Order History</a></li>
</ul>
@stop


@section('content')

    <div class="shop-page order-history large-margin-top">
        <div class="row">
            <div class="col-md-3">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark bold uppercase">Welcome {!! $loggedUser->username ? $loggedUser->username : $loggedUser->f_name !!} </span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        @include('_partials.frontend.side_quick_links')
                    </div>
                </div> 
            </div>

            <div class='col-sm-9'>
                <h2 class="page-title no-margin-top large-margin-bottom">
                    Order History 
                </h2>
                @if(count($orders))
                 <div class="table-responsive">
                    <table class="datatable table table-striped table-hover display" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th sortable>Date</th>
                            <th>Order #</th>
                            <th>Ship to</th>
                            <th sortable>Total</th>
                            <th sortable>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($orders as $order)
                             <tr>
                                <td>
                                    {{date("d M Y - H:i", strtotime($order->created_at))}}
                                </td>
                                <td>
                                    #{{ $order->order_number }}
                                </td>
                                <td>
                                    <strong>{{ $order->customer_name}}</strong>  
                                </td>
                                <td style="white-space:nowrap;">
                                    <span class="green-text">Total: {{ $order->currency == 'GBP' ? '£' : '$' }}{{  number_format(($order->price + $order->ship_fee), 2, '.', ' ') }} </span>
                                </td>
                                
                                <td>
                                    @if($order->items )
                                        <span class="label label-xs label-square label-{!! Modules\Shop\Helper::orderStatusColour($order->status) !!}">{!! Modules\Shop\Helper::orderStatus($order->status) !!}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions pull-right">
                                        <div class="btn-group">
                                          <button type="button" class="btn dark btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
                                            <span class="caret ml5"></span>
                                          </button>
                                          <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="{{ route('viewOrderDetails', $order->token ) }}"> 
                                                    <i class="i"></i> <i class="fa fa-eye"></i> View Order
                                                </a>
                                            </li>
                                            @if($order->status == 0)
                                                <li>
                                                    {!! Former::open( route('shop.order.delete',$order->id) )->method('POST') !!}                                    
                                                    <button type="submit" class="actionButton"><i class="fa fa-trash-o"></i> Delete Order</button>
                                                    {!! Former::close() !!}  
                                                </li>
                                            @endif
                                          </ul>
                                        </div>
                                    </div>
                                </td>
                              </tr>
                          
                          @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                    <i>No orders placed</i>
                @endif
            </div>
        </div>
    </div>
@stop
