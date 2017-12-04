<?php
$cart = Modules\Shop\Cart::getCurrent();
$isEmpty = $cart->isEmpty();
$items = \Modules\Shop\Cart::getCurrent()->getItems();
$ukFreeShipping = Modules\Shop\Models\Setting::where('key','uk_free_shipping')->first();
$inBag = count($items);
?>
<div class="shop-page cart-page">
    <div class="row">
        @if($isEmpty)
        <div class="col-md-12 padding-top-large">
            <p class='align-center'>Your bag is empty</p>
        </div>
        @else
        <div class="col-sm-12"  id="shop-cart-popup-content" data-courses-only="{{cart()->isHaveCoursesOnly()}}">
            <?php
            $currencyManager = \Modules\Shop\CurrencySessionManager::getInstance();
            $currency = $currencyManager->getCurrency();

            ?>
            @if(!cart()->isEmptyItems())
            <table class="table no-margin-bottom">
                @if($ukFreeShipping)
                    <tr>
                        <td colspan="3"><p class="align-center no-margin-bottom padding-top-small"><b class="free-delivery">FREE UK Delivery</b> ON ORDERS OVER £{{$ukFreeShipping->value}}</p></td>
                    </tr> 
                @endif          
            </table>
            <table class="table no-margin-bottom">
                <thead>
                    <tr>
                        <th style="width:120px !important;">Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
            </table>
            @endif
            <div class="table-scoller">
                <table class="table no-margin-bottom">
                    @foreach($items as $id => $item)
                    <tr>
                        <td class="popupCartListImageHolder">
                            <a title="{{$item->getName()}}" href="{{route('shop.products.show',['slug'=>$item->getSlug()])}}">
                                <img  width="60px" src="{{asset($item->getImage())}}" alt="" class="img-thumbnail popup img-responsive" data-toggle="tooltip" data-placement="right" title="{{$item->getName()}}"/>      
                            </a>
                            <span class="badge deleteItem badge-danger"
                                  onclick="ShopCart.quickRemove(this)" data-url="{{route('shop.cart.removeItem',$id)}}"
                                  data-toggle="tooltip" data-placement="right" title="Remove Item">
                                <i class="fa fa-times"></i>
                            </span>

                        </td>
                        <td style="vertical-align: middle;">
                            @if($item->getOldPrice() !== NULL )
                            <del class="text-danger">{{$currencyManager->formatPriceWithCurrency($item->getOldPrice())}}</del>
                            @endif
                            <br/>
                            {{$currencyManager->formatPriceWithCurrency($item->getPrice())}}
                        </td>
                        <td  style="vertical-align: middle;">
                            {{$item->getQuantity()}}
                        </td>
                        <td style="text-align: right; vertical-align: middle; white-space:nowrap; padding-right:20px;">
                            {{$currencyManager->getCurrencySymbol()}}<span class="sub-total">{{$item->getPrice() * $item->getQuantity()}}</span>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <table class="table no-margin-bottom">
                @if(!cart()->isEmpty())
                <tr>
                    <td>
                        <a href="{!! url('shop/cart') !!}"> 
                            <span class="label label-warning"> View Cart</span>
                        </a> 
                    </td>
                    <td>
                        <a href="{{route('shop.order.create')}}">
                            <span class="small-margin-left label label-success"><i class="icon-credit-card"></i> Checkout</span>
                        </a>
                    </td>
                    <td style="text-align: right">
                        @if(!cart()->getDiscount())
                        <strong>Total : {{$currencyManager->getCurrencySymbol()}}{{\Modules\Shop\Cart::getCurrent()->total()}}</strong>
                        @else
                        <strong>Subtotal : {{$currencyManager->getCurrencySymbol()}}{{\Modules\Shop\Cart::getCurrent()->subTotal()}}</strong>
                        <br>
                        <strong>Discount : {{$currencyManager->getCurrencySymbol()}}{{ number_format(\Modules\Shop\Cart::getCurrent()->discountTotal(),2) }}</strong>
                        <br>
                        <strong>Total : {{$currencyManager->getCurrencySymbol()}}{{\Modules\Shop\Cart::getCurrent()->total()}}</strong>
                        @endif
                    </td>
                </tr> 
                    @if($ukFreeShipping)
                        
                        <tr>
                            <td colspan="3">
                                @if(\Modules\Shop\Cart::getCurrent()->total() < $ukFreeShipping->value )
                                    <?php
                                        $rate = '0';
                                        $weight = cart()->getWeight();
                                        switch ( $weight ) {  

                                            case $weight > '250' && $weight < '400':
                                                    $rate = '1.50';
                                                break;

                                            case $weight > '1750' && $weight < '10000':
                                                    $rate = '3.99';
                                                break;

                                            case $weight > '10000' && $weight < '20000':
                                                    $rate = '5.99';
                                                break;

                                            case $weight > '20000' && $weight < '32001':
                                                    $rate = '7.99';
                                                break;
                                            
                                            default:
                                                $rate = '1.99';
                                                break;
                                        }
                                    ?>

                                    <p class="align-center no-margin-bottom"> <a href="/delivery-information">Estimated delivery</a> within the UK is £{{$rate}}</p>
                                @else
                                    <p class="align-center no-margin-bottom"> <strong>YOU QUALIFY FOR FREE DELIVERY</strong></p>
                                @endif
                            </td>
                        </tr>
                    @endif          
                @endif
            </table>
        </div>
        @endif
    </div>
</div>