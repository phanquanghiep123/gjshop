{!! Former::open()->route('shop.cart.quickBuy')->method("POST")->onsubmit('ShopCart.addItem(this);return false;') !!}
<input type="hidden" value="{{$product->id}}" name='id' />
<input type="hidden" value="{{$product->name}}" name='product_name' />
<input type="hidden" value="{{$product->points}}" name='points' />
<button type="submit" class="btn productListCart btn-sm  small-margin-right" data-toggle="tooltip" data-placement="top" title="Add item to bag"><i class="icon-handbag"></i></button>
{!! Former::close() !!}