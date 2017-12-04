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
                                <br>
                                <div v-if="discount">
                                    <strong>Discount : -{{$currencyManager->getCurrencySymbol()}}@{{discount}}</strong>
                                    <input name="discount" type="hidden" vale="{{$currencyManager->getCurrencySymbol()}}@{{discount}}">
                                    <br>
                                </div>
                                <?php if($loggedUser ){?>
                                <?php if(@$cart->redeem["use"] == 1 ){?>
                                    <div id="total_redeem">
                                        <strong>Redeem Total : -{{$currencyManager->getCurrencySymbol()}}<span id="number_redeem">{{ $cart->getRedeemTotal()}}</span> </strong>
                                        <br>
                                    </div>
                                <?php } else { ?>
                                    <div id="total_redeem" style="display: none;">
                                        <strong>Redeem Total : -{{$currencyManager->getCurrencySymbol()}}<span id="number_redeem">{{ $cart->getRedeemTotal()}}</span> </strong>
                                        <br>
                                    </div>
                                <?php }?>
                                <?php } ?>
                                <div v-if="delivery" id="delivery">
                                    <strong>Delivery : {{$currencyManager->getCurrencySymbol()}}@{{delivery}}</strong>
                                    <input name="delivery" type="hidden" vale="{{$currencyManager->getCurrencySymbol()}}@{{delivery}}">
                                    <br>
                                </div>
                                <strong>Total : {{$currencyManager->getCurrencySymbol()}}@{{countedTotal ? countedTotal : total}} </strong>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="table no-margin-bottom">
                            @if($loggedUser && $loggedUser->points >= $minimum_redeemable_points->value)
                            <tr>
                                
                                <td colspan="2">
                                    <input type="hidden" id="point_per_price" value="{{ $minimum_redeemable_points->value }}" /> 
                                    <input type="hidden" id="value-use-redeem" name="use-redeem" value="@if($GetRedeem['use'] == 1){{"0"}}@else{{ "1" }}@endif">
                                    <a href="javascript:;" id="use-redeem" data-use="no" class="btn btn-points btn-sm">
                                        <span id="lable-redeem">@if($GetRedeem['use'] == 1){!! 'Cancel ' !!} @endif </span> 
                                        Redeem <span id="number_point">{{ $get_point }}</span> Points (£<span id="number_price">{{ priceValueByPoint($get_point) }}</span>)
                                    </a>
                                </td>
                            </tr>
                            @endif
                            <tr v-if="discount">
                                <td>
                                    <button type="button" class="btn btn-danger"  v-on:click="removeDiscount(discount)"> Remove voucher</button>
                                </td>
                                <td></td>
                            </tr>
                            <tr v-if="!discount">
                                <td style="width:80%"><input v-model="code" class="form-control" placeholder="Voucher or Referrer Code" id="discount_code" type="text" name="discount_code"></td>
                                <td style="width:20%"><a class="btn btn-sm dark" v-on:click="applyDiscount()">Apply Code</a></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="{!! url('shop') !!}" style="width:100%;" class="btn btn-sm btn-default"> 
                                        Continue Shopping
                                    </a>
                                    <hr class="dashed medium-margin-top medium-margin-bottom"/>
                                    <div id="payment" class="woocommerce-checkout-payment">
                                       <ul class="wc_payment_methods payment_methods methods">
                                          <li class="wc_payment_method payment_method_paypal">
                                             <input checked id="payment_method_paypal" type="radio" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal">
                                             <label for="payment_method_paypal">
                                             PayPal <img src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png" alt="PayPal acceptance mark"><a href="https://www.paypal.com/gb/webapps/mpp/paypal-popup" class="about_paypal" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">What is PayPal?</a>  </label>
                                             <div class="payment_box payment_method_paypal">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                             </div>
                                          </li>
                                          <li class="wc_payment_method payment_method_stripe">
                                             <input id="payment_method_stripe" type="radio" class="input-radio" name="payment_method" value="stripe" data-order_button_text="">
                                             <label for="payment_method_stripe">
                                             Credit Card (Stripe) <img src="http://onepage-demo.optart.biz/wp-content/plugins/woocommerce/assets/images/icons/credit-cards/visa.svg" alt="Visa" width="32" style="margin-left: 0.3em"><img src="http://onepage-demo.optart.biz/wp-content/plugins/woocommerce/assets/images/icons/credit-cards/mastercard.svg" alt="Mastercard" width="32" style="margin-left: 0.3em"><img src="http://onepage-demo.optart.biz/wp-content/plugins/woocommerce/assets/images/icons/credit-cards/amex.svg" alt="Amex" width="32" style="margin-left: 0.3em">  </label>
                                             <div class="payment_box payment_method_stripe" style="">
                                                <div id="stripe-payment-data" data-panel-label="" data-description="" data-email="" data-amount="5400" data-name="OnePage Demo" data-currency="gbp" data-image="" data-bitcoin="false" data-locale="en" data-allow-remember-me="true">
                                                   <p>Pay with your credit card via Stripe. TEST MODE ENABLED. In test mode, you can use the card number 4242424242424242 with any CVC and a valid expiration date or check the documentation "<a href="https://stripe.com/docs/testing">Testing Stripe</a>" for more card numbers.</p>
                                                   <fieldset id="wc-stripe-cc-form" class="wc-credit-card-form wc-payment-form">
                                                      <p class="form-row form-row-wide">
                                                         <label for="stripe-card-number">Card number <span class="required">*</span></label>
                                                         <input id="stripe-card-number" type="text" name="stripe[number_car]" placeholder="•••• •••• •••• ••••">
                                                      </p>
                                                      <p class="form-row form-row-first">
                                                         <label for="stripe-card-expiry">Moth (MM) <span class="required">*</span></label>
                                                         <input id="stripe-card-expiry" name="stripe[moth]" type="text" placeholder="YY">
                                                      </p>
                                                      <p class="form-row form-row-first">
                                                         <label for="stripe-card-expiry">Year (YY) <span class="required">*</span></label>
                                                         <input id="stripe-card-expiry" name="stripe[year]" type="text" placeholder="YY">
                                                      </p>
                                                      <p class="form-row form-row-last">
                                                         <label for="stripe-card-cvc">Card code <span class="required">*</span></label>
                                                         <input id="stripe-card-cvc" name="stripe[cvc]" type="text" placeholder="CVC">
                                                      </p>
                                                      <div class="clear"></div>
                                                   </fieldset>
                                                </div>
                                             </div>
                                          </li>
                                       </ul>
                                      
                                    </div>
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
<style type="text/css">
#payment .payment_methods li img {
    float: right;
    border: 0;
    padding: 0;
    max-height: 1.618em;
    margin-left: 10px;
}
#payment .payment_methods a {
    color: #8DAB57;
}

#payment .payment_methods input[type="text"] {
    float: right;
}
</style>