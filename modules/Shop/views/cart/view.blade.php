@extends(config('shop.product'))

@section('title') Your Cart @stop


@section('content')
<?php
$cart = Modules\Shop\Cart::getCurrent();
$isEmpty = $cart->isEmpty();
$items = \Modules\Shop\Cart::getCurrent()->getItems();
$inBag = cart()->countItems();

?>
<div class="shop-page cart-page">
    <div id="cart-empty-row" class="row" @if(!$isEmpty) style="display:none" @endif>
         <div class="col-md-12">
             <h2 class="mainCatTitle no-margin-top">What's in your bag?</h2>
            <p><em>Your bag is empty</em></p>
        </div>
    </div>
    <div id="cart-nonempty-row" class="row" @if($isEmpty) style="display:none" @endif>
        <div class="col-sm-12">
            <h2 class="mainCatTitle no-margin-top">What's in your bag?</h2>
            @if(!$isEmpty)
            <p class="pull-right whatsInBag">Items in your bag  (<span class="cart-item-couter">{{ $inBag }}</span>)</p>
            @endif
        </div>
        <div class="col-sm-12 cartScroller">
            <table class='table table small-margin-top'>
                <div class="temp" style="display:none"></div>
                <?php
                $currencyManager = \Modules\Shop\CurrencySessionManager::getInstance();
                $currency = $currencyManager->getCurrency();
                ?>
                @foreach($items as $id => $item)
                <tr>
                    <td class="cartListImageHolder">                            
                            <a href="{{route('shop.products.show',['slug'=>$item->getSlug()])}}">  
                                <img  width="125px" src="{{asset($item->getImage())}}" alt="" class="img-thumbnail img-responsive" data-toggle="tooltip" data-placement="right" title="View Item"/>
                            </a>
                    </td>
                    <td class="cartListInfo" style="width:70%">
                        <h3 class="cartItemTitle"><a href="{{route('shop.products.show',['slug'=>$item->getSlug()])}}">{{$item->getName()}}</a></h3>
                        
                        @if($item->getPoints())
                        <div class="purchase_loyalty_point">
                                Earn {{ $item->getPoints() }} Points
                        </div>
                        @endif

                        <p class="cartListPrice small-margin-bottom">Price : 
                            @if($item->getOldPrice() !== NULL )
                            <del class="text-danger">{{$currencyManager->formatPriceWithCurrency($item->getOldPrice())}}</del>
                            @endif
                            {{$currencyManager->formatPriceWithCurrency($item->getPrice())}} 
                        </p>
                        <div class="cartListDesc hidden-xs">{!! neat_trim( $item->getDescription(), 230) !!} </div>
                    </td>
                    
                    <td  style="vertical-align: middle;">
                        <input data-id="{{$id}}" class="form-control qty_box" onchange="ShopCart.updateQuantity(this)" value="{{$item->getQuantity()}}" name="quantity" />
                    </td>
                    <td style="vertical-align: middle; white-space:nowrap">
                        {!! Former::open()->route('shop.cart.removeItem',$id)->method("DELETE")->onsubmit('ShopCart.removeItem(this);return false;') !!}
                        <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Remove Item"><i class="fa fa-trash"></i></button>
                        {!! Former::close() !!}
                    </td>
                    <td style="text-align: right; vertical-align: middle; white-space:nowrap">
                        <strong>Subtotal :</strong> {{$currencyManager->getCurrencySymbol()}}<span class="sub-total">{{$item->getPrice() * $item->getQuantity()}}</span>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        @if(count($items))
        <div id="car-bottom-form">
            @include('shop::_partials.cart.cartFormContent')
        </div>
        @endif
    </div>
</div>
<style type="text/css">
    #shop-cart-popup-content .deleteItem {
        display: none;
    }
</style>
@stop

@section('js')
@stop
