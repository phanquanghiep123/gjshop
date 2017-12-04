@if(count($shippingMethods))
<?php 
    $cheapest = 0;
    $feeList = [];
    foreach($shippingMethods as  $method) {
        $feeList[] = $method->fee;
    }
    $cheapest = min($feeList);
?>
<div class="radio">
    <ul>
        <p class="no-margin-bottom"><strong>Select Shipping Method:</strong></p>
        @foreach($shippingMethods as   $method) 
        <li>
            <label>
                <input data-fee="{{$method->fee}}" onchange="orderSummary.setDelivery({{$method->fee}})" type="radio" required="required" name="shipping_method" value="{{$method->id}}" <?php if($method->fee == $cheapest) echo "checked" ?>>
                {{$method->name}}  @if($method->fee) ({{$method->duration}}) - {!! $method->getFeeBaseOnContinentFormated(cart()) !!} @endif
            </label>
        </li>
        @endforeach
    </ul>
</div>
@else 
<i class="text-danger">Sorry! There are no shipping rates available, please <a href="/contact-us">contact us</a> to place your order</i>
@endif