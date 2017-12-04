<?php $currencyManager = \Modules\Shop\CurrencySessionManager::getInstance(); ?>
<?php
    if(cart()->getDiscount()) {
        $actionName = 'removeDiscount';
    }else{
        $actionName = 'applyDiscount';
    }
?>
{!! Former::open()->id('discount_code')->onsubmit("ShopCart.$actionName(this);return false;")->route('shop.discount.apply') !!}
{!! Former::token() !!}
<div class="col-sm-12">
    <table class='table small-margin-bottom' id='discount-table'>
        <tr>
            <td colspan="4">
                <div class="row">
                    <div class="col-xs-12 col-sm-8 col-md-8">
                        @if(!cart()->getDiscount())
                        {!! Former::text('code','')->class('form-control pull-left')->placeholder('Enter Voucher Code') !!}
                        @endif
                    </div>
                </div>
            </td>
            <td colspan="1" style="text-align: right">
                @if(cart()->getDiscount())
                <h3 class="cartTotal">Sub Total : <span id="sub-total">{{$currencyManager->getCurrencySymbol()}}{{cart()->subTotal()}}</span></h3>
                <h3 class="cartTotal">Discount : <span id="discount-amount">{{$currencyManager->getCurrencySymbol()}}{{cart()->discountTotal()}}</span></h3>
                @endif
                <h3 class="cartTotal">Total : {{$currencyManager->getCurrencySymbol()}}<span id="cart-total">{{\Modules\Shop\Cart::getCurrent()->total()}}</span></h3>
            </td>
        </tr>
    </table>
</div>
<div class="col-sm-12" style="text-align: right">
    <a class="btn btn-warning btn-sm" href="{{route('shop.categories.lists')}}">Continue shopping</a>
    @if(!cart()->getDiscount())
    {!! Former::submit('Apply Voucher')->class('btn dark btn-sm')->id('discount-apply-btn') !!}
    @else 
    {!! Former::submit('Remove Voucher')->class('btn dark btn-sm')->id('discount-apply-btn') !!}
    @endif
    <a class="btn btn-success btn-sm" href="{{route('shop.order.create')}}">Checkout <i class="icon-credit-card"></i> </a>
</div>
{!! Former::close() !!}
