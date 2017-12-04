@extends('layouts.no_right_side')

@section('title') Account Overview @stop


@section('breadcrumb')

<ul class="breadcrumb">
    <li><a href="{!! url('/') !!}"><img src="{{asset('assets/frontend/images/home_icon.png') }}" alt="back home" /></a></li>
    <li><a href="#">Account Overview</a></li>
</ul>
@stop

@section('content')

<!--div class="row large-margin-top">
    <div class="col-md-12">
        <h4>Welcome {!! $loggedUser->username ? $loggedUser->username : $loggedUser->f_name !!}</h4>
    </div>
</div-->

<?php
    $pendingOrders = $loggedUser->getPendingShippingOrders();
    $orderCount = count($pendingOrders);
    $pending_commission = Modules\Shop\Models\Commission::one_off_commissions($loggedUser->id);
?>

<div class="row large-margin-top" id="my_account">
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
            <h4 class="account-page-title no-margin-top large-margin-bottom"> <i class="icon-user"></i> Account Overview</h4>
        </div>
    <div class="row">
        <!-- div class="col-xs-3">
            <img src="{{ $loggedUser->avatar ? asset($loggedUser->avatar) : asset('assets/frontend/images/male-avatar.png') }}" class="img-responsive avatar">
        </div-->
        <div class="col-xs-6">
            <div class="points-dash">
                <h4 class="no-margin-bottom">YOU HAVE EARNED </h4>
                <p>
                    <span class="due-commission-dash">{{$loggedUser->points}}</span><br/>
                    <small>Loyalty points, which are worth {{pointsValueFormatted($loggedUser)}} </small>
                </p>
            </div>
        </div>
        @if($loggedUser->advocate)
            <div class="col-xs-6">
                <div class="commission-dash">
                    <h4 class="no-margin-bottom">PENDING COMMISSIONS</h4>
                    <p>
                        <span class="due-commission-dash">£200</span><br/>
                        <small>for the month of {{ date('F')}}</small>
                    </p>
                </div>
            </div>
        @else
            <div class="col-xs-6">
                <div class="commission-dash">
                    <h4 class="no-margin-bottom">PENDING COMMISSIONS</h4>
                    <p>
                        <span class="due-commission-dash">£{{ number_format($pending_commission,2) }}</span><br/>
                        <small>Please check your commissions dashboard</small>
                    </p>
                </div>
            </div>
        @endif
        <div class="col-xs-12">
            <hr class="dashed"/>
        </div>

        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <h4>ORDERS AWAITING TO BE DESPATCHED ({{ $orderCount }}) <a href="{{ route('viewHistory') }}"><small class="pull-right">VIEW ALL ORDERS</small></a></h4>

                    @if($orderCount)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingOrders as $order)
                                    <tr>
                                        <td><a href="{{ route('viewOrderDetails', $order->token ) }}">{{ $order->order_number }}</a></td>
                                        <td>{{date("d M Y - H:i", strtotime($order->created_at))}}</td>
                                        <td>{{ $order->currency == 'GBP' ? '£' : '$' }}{{  number_format(($order->price + $order->ship_fee + $order->redeem_price), 2, '.', ' ') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p><em>You have no orders awaiting delivery.</em></p>
                    @endif
                </div> 
            </div>
        </div>

        <div class="col-xs-12">
            <hr class="dashed"/>
        </div>

        <div class="col-xs-12">
            <h4>3 FAVOURITE PRODUCTS ({{ $loggedUser->favoriteProducts->count() }}) <a href="{{ route('my_favorites') }}"><small class="pull-right">VIEW ALL</small></a></h4>
            <?php $fProducts = $loggedUser->favoriteProducts()->take(3)->get(); ?>
            <ul class="small-margin-top">
                @if(count($fProducts))
                    @foreach($fProducts as $fProduct)
                    <li>
                        <a href="{{route('shop.products.show',['slug'=>$fProduct->slug])}}">
                            {{ $fProduct->name }}
                        </a>
                    </li>
                    @endforeach
                @else
                    <li><em>You have no products in your favourites list!</em></li>
                @endif
                <div class="clear-fix"></div>
            </ul>
        </div>

        <div class="col-xs-12">
            <hr class="dashed"/>
        </div> 

        <div class="col-xs-12">
            <h4>3 FAVOURITE ARTICLES ({{ $loggedUser->favoriteArticles->count() }}) <a href="{{ route('my_favorites') }}"><small class="pull-right">VIEW ALL</small></a></h4>
            <?php $fArticles = $loggedUser->favoriteArticles()->take(3)->get(); ?>
            <ul class="small-margin-top">
                @if(count($fArticles))
                    @foreach($fArticles as $fArticle)
                    <?php 
                        $category = $fArticle->categories->first();
                        $link = route('detailtArticle',['categorySlug'=>$category->slug,'slug'=>$fArticle->slug]); 
                    ?>
                    <li>
                        <a href="{{$link}}">
                            {{ $fArticle->title }}
                        </a>
                    </li>
                    @endforeach
                @else
                    <li><em>You have no articles in your favourites list!</em></li>
                @endif
                <div class="clear-fix"></div>
            </ul>
        </div>

        <div class="col-xs-12">
            <hr class="dashed"/>
        </div>
    </div>

    </div>
</div>
@endsection

@section('js')

@endsection