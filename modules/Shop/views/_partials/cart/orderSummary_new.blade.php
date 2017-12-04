<?php
$cart = Modules\Shop\Cart::getCurrent();
$isEmpty = $cart->isEmpty();
$items = \Modules\Shop\Cart::getCurrent()->getItems();
$inBag = count($items);
$minimum_redeemable_points = \Modules\Shop\Models\Setting::where('key','loyalty_points_ratio')->first();

?>
<div class="shop-page cart-page" id="shop-order-summary">

    <div class="row">
        <div v-if="isEmpty" class="col-md-12 padding-top-large">
            <p class='align-center'>Your bag is empty</p>
        </div>
        <div v-if="!isEmpty" class="col-sm-12"  id="shop-cart-summary" data-courses-only="{{cart()->isHaveCoursesOnly()}}">
            <?php
            $currencyManager = \Modules\Shop\CurrencySessionManager::getInstance();
            $currency = $currencyManager->getCurrency();

            ?>
            @if(!cart()->isEmptyItems())
            <table class="table no-margin-bottom">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th class="align-center">Qty</th>
                        <th class="align-right">Total</th>
                    </tr>
                </thead>
            </table>
            @endif
            <div class="table-scoller">
                <table class="table no-margin-bottom" id="cart-items-table">
                    <div class="cart-temp" style="display:none"></div>

                    @foreach($items as $id => $item)
                    <tr data-item-id="{{$id}}">
                        <td class="popupCartListImageHolder">
                            <a title="{{$item->getName()}}" href="{{route('shop.products.show',['slug'=>$item->getSlug()])}}">
                                <img  width="60px" src="{{asset($item->getImage())}}" alt="" class="img-thumbnail popup img-responsive" data-toggle="tooltip" data-placement="top" title="{{$item->getName()}}"/>      
                            </a>
                            <span class="badge deleteItem badge-danger"
                                  v-on:click="removeItem({{$id}},{{$item->getPrice()*$item->getQuantity()}})"
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
            <div>
                @if($loggedUser)
                <div class="temp"></div>
                @endif
                <div class="form-group">
                    <hr class="dashed small-margin-top medium-margin-bottom"/>
                    <div id="allowed-shipping-methods">
                        <i>Please enter address first</i>
                        <input type="hidden" name="shipping_method" value="0" />
                    </div>
                </div>
            </div>

            @if(!cart()->isEmpty())
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{!! url('shop/cart') !!}"> 
                                <span class="label label-warning"> Edit Bag</span>
                            </a>

                        </div>
                        <?php
                        $GetRedeem = @$cart->GetRedeem() ;
                        $get_point = $price_current = 0;
                        if($loggedUser){
                            $get_point     = \Auth::user()->points; 
                            $price_current = @priceValueByPoint($get_point);
                            $price_redeem  = 0;
                            if(@$GetRedeem['use'] == 1){
                                $get_point      = \Auth::user()->points - @$GetRedeem['points'];  
                            }
                        }

                        ?>
                        <div class="col-md-8">
                            <div style="text-align:right; font-size:15px;">
                                <strong>Bag Total : {{$currencyManager->getCurrencySymbol()}}@{{bagTotal}}</strong>
                                <div v-if="delivery" id="delivery">
                                    <strong>Delivery : {{$currencyManager->getCurrencySymbol()}}@{{delivery}}</strong>
                                    <input name="delivery" type="hidden" vale="{{$currencyManager->getCurrencySymbol()}}@{{delivery}}">
                                </div>
                                <div v-if="discount">
                                    <strong>Discount : -{{$currencyManager->getCurrencySymbol()}}@{{discount}}</strong>
                                    <input name="discount" type="hidden" vale="{{$currencyManager->getCurrencySymbol()}}@{{discount}}">
                                    <br>
                                </div>
                                
                                <?php if($loggedUser ){?>
                                <?php if(@$cart->redeem["use"] == 1 ){?>
                                    <div id="total_redeem">
                                        <strong>Redeem Total : -{{$currencyManager->getCurrencySymbol()}}<span id="number_redeem">{{ $GetRedeem['price'] }}</span> </strong>
                                        <br>
                                    </div>
                                <?php } else { ?>
                                    <div id="total_redeem" style="display: none;">
                                        <strong>Redeem Total : -{{$currencyManager->getCurrencySymbol()}}<span id="number_redeem">{{ $GetRedeem['price'] }}</span> </strong>
                                        <br>
                                    </div>
                                <?php }?>
                                <?php } ?>
                                <strong>Total : {{$currencyManager->getCurrencySymbol()}}@{{countedTotal ? countedTotal : total}} </strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table no-margin-bottom">
                            @if($loggedUser && $loggedUser->points >= $minimum_redeemable_points->value)
                            <tr>
                                
                                <td colspan="2">
                                    <input type="hidden" id="value-use-redeem" name="use-redeem" value="@if($GetRedeem['use'] == 1){{"0"}}@else{{ "1" }}@endif">
                                    <a href="javascript:;" id="use-redeem" data-use="no" class="btn btn-points btn-sm">
                                        <span id="lable-redeem">@if($GetRedeem['use'] == 1){!! 'Cancel ' !!} @endif </span> 
                                        Redeem <span id="number_point">{{ $get_point }}</span> Points (£<span id="number_price">{{ priceValueByPoint($get_point) }}</span>)
                                    </a>
                                </td>
                            </tr>
                            @endif
                            <tr  v-if="!discount">
                                <td style="width:80%"><input v-model="code" class="form-control" placeholder="Voucher or Referrer Code" id="discount_code" type="text" name="discount_code"></td>
                                <td style="width:20%"><a class="btn btn-sm dark" v-on:click="applyDiscount()">Apply Code</a></td>
                            </tr>
                            <tr v-if="discount">
                                <td>
                                    <button type="button" class="btn btn-danger"  v-on:click="removeDiscount(discount)"> Remove voucher</button>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="{!! url('shop') !!}" style="width:100%;" class="btn btn-sm btn-default"> 
                                        Continue Shopping
                                    </a>
                                    <hr class="dashed medium-margin-top medium-margin-bottom"/>
                                    <button type="submit" v-on:click="goCheckout()" style="width:100%;" class="btn btn-success">
                                        Submit Order                                
                                    </button>
                                </td>
                            </tr> 
                            <tr>
                                <td colspan="2">
                                    <p class="align-center no-margin-bottom">
                                        <img src="{{ asset('/assets/frontend/images/paypal-logo.png')}}"><br/>
                                        Credit/Debit Card payments are processed by PayPal, no account is required.
                                    </p>
                                </td>
                            </tr>   
                        </table>
                    </div>    
                </div>
            @endif
        </div>
    </div>
</div>