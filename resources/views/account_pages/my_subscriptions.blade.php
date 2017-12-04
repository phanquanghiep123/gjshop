@extends('layouts.no_right_side')

@section('title') Subscriptions & Stock Notifications @stop


@section('breadcrumb')

<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{{asset('assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="{{ route('my_account')}}">Account</a></li>
    <li><a href="#">Subscriptions & Stock Notifications</a></li>
</ul>
@stop

@section('content')
<?php
$productSubscriptions = \Modules\Shop\Models\StockNotificationEmail::with('product')->where('user_id', $loggedUser->id)->get();
$emailSubscription = \App\Newsletter::where('signup_email', $loggedUser->email)->first();

?>
<div class="row large-margin-top">
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
    <div class="col-md-9">
        @include('_partials.backend.notifications')
        <div>
            <h4 class="account-page-title no-margin-top large-margin-bottom"> <i class="fa fa-clock-o"></i> My Subscriptions</h4>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="well">
                    <h3>Product Replenishment Notifications</h3>
                    <p>You will be emailed when the following products are back in stock.</p>

                    <table class="table" id='subscriptions-table'>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($productSubscriptions))
                            @foreach( $productSubscriptions as $subscription )
                            <?php $product = $subscription->product; ?>
                            <tr>
                                <td><a href="{{route('shop.products.show',['slug'=>$product->slug])}}">{{$product->name}}</a></td>
                                <td>{{$product->inventory < 1 ?  'No' :  'Yes' }}</td>
                                <td>
                                    <div class="actions">
                                        <div class="btn-group">
                                            <button type="button" class="btn dark btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-gear"></i>
                                                <span class="caret ml5"></span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li>
                                                    {!! Former::open()->route('delete_subscription')->method('POST')->onsubmit('Subscriptions.removeSubscription(this);return false;') !!} 
                                                    {!! Former::hidden('id',$subscription->id) !!} 


                                                    

                                                    <button type="submit" class="actionButton">
                                                        <i class="glyphicon glyphicon-trash"></i> Cancel Notification
                                                    </button>
                                                    {!! Former::close() !!}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr><td><p><em>You have no product replenishment subscriptions</em></p></td></tr>
                            @endif
                        </tbody>
                    </table>     
                </div>           
            </div>
            @if($emailSubscription)
            <div class="col-md-12">
                <div class="well">
                    <h3>Updates Subscription <i class="fa fa-envelope"></i> </h3>
                    <p>You will receive updates about new articles, product releases, special offers, competitions and more. Don't worry we won't overload your inbox.</p>
                    {!! Former::open()->route('cancel_signup')->method('POST') !!} 
                    {!! Former::hidden('signup_email', $loggedUser->email ) !!}                                   
                    <button type="submit" class="btn btn-success"><i class="glyphicon glyphicon-trash"></i> Cancel Subscription</button>
                    {!! Former::close() !!}
                </div>           
            </div>
            @endif
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script type="text/template" id='empty-subscription-tr'>
    <tr><td><p><em>You have no product replenishment subscriptions</em></p></td></tr>
</script>
<script type="text/javascript">
    
</script>
@endsection