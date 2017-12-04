<div id='shop-cart-popup-wraper'>
    @if(cart()->isEmpty())
        <a class="" href="{!! url('shop/cart') !!}"> <i class="icon-basket"></i> 
        <span class="badge badge-success cart-item-couter" id="shop-cart-number-items"></span>
        </a>
    @else
        <a class="" href="{!! url('shop/cart') !!}"> <i class="icon-handbag"></i><span class="badge badge-success" id="shop-cart-number-items">{{cart()->countItems()}}</span></a>
    @endif
    <div class="shop-cart-popup">
        @include('shop::_partials.cart.popupContent')
    </div>
</div>