@extends( config('shop.checkout') )

@section('title') 
    Check Out
@stop

@section('content')
<?php
$ukFreeShipping = Modules\Shop\Models\Setting::where('key', 'uk_free_shipping')->first();
?>
<div class="shop-page" id="checkout-page">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mainCatTitle no-margin-top">
                Checkout @if($ukFreeShipping)
                <span class="pull-right">
                    <span class="free-delivery">FREE UK Delivery</span> on orders over £{{$ukFreeShipping->value}}
                </span>
                @endif
            </h2>
        </div>
    </div>
    <div class="row medium-margin-top">
        <div class="col-md-12">
            @if(session()->has('messages'))
            <div class="alert alert-danger">
                <ul class="padding-left-large light-text">
                    @foreach (session()->get('messages') as $error)
                    <li>
                        {{ $error }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
    <div class="row">
        {!! Former::open_vertical()->route('shop.order.store')->id('order-create-form')->novalidate() !!}
        {!! Former::token() !!}
        @if (Auth::user())
        <?php
        $user = Auth::user();
        Former::populate([
            'f_name' => $user->f_name,
            'l_name' => $user->l_name,
            'email' => $user->email,
            'phone' => $user->mobile,
                //'country' => $user->country,
                //'city' => $user->city,
                //'state' => $user->state,
                //'address' => $user->address,
        ]);

        ?>
        {!! Former::hidden('user_id',$user->id) !!}
        {!! Former::hidden('f_name',$user->f_name) !!}
        {!! Former::hidden('l_name',$user->l_name) !!}
        @endif 

        @include('shop::_partials.order.createWithItems') 

        {!! Former::close() !!}
    </div>
</div>
<style type="text/css">
    #shop-cart-popup-content .deleteItem {
        display: none;
    }
</style>
@stop

@section('scripts')
    <script id="choose-shipping-country-first-template" type="text/template">
        <i>Please enter an address</i>
        <input type="hidden" name="shipping_method" value="0" />
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#zip_code').val('');
            $('#order-create-form [name="region"]').val('');
            $('#order-create-form [name="country"] option').remove();
            //$('#order-create-form [name="country"] city_state').remove();
            $('#order-create-form [name="country"]').attr('disabled', 'disabled');
            //$('#order-create-form [name="city_state"]').attr('disabled', 'disabled');
            $('#order-create-form [name="register"]').prop('checked', false);
            $('#order-create-form .btn').removeAttr('data-loading');
            $('#order-create-form .btn').removeAttr('disabled');


            if($('#address_info').is(':visible')){
                $('#allowed-shipping-methods').html('<i>Please enter an address</i>');
                $('#allowed-shipping-methods').addClass('alert alert-danger');
                $('#allowed-shipping-methods').show();
            }


            $('#address_box').click( function(){
                if($('#address_info').is(':hidden')){
                    orderSummary.setDelivery(0);
                    $('#order-create-form [name="region"]').val('');
                    $('#order-create-form [name="city_state"]').val('');
                    $('#order-create-form [name="town"]').val('');
                    $('#order-create-form [name="address"]').val('');
                    $('#order-create-form [name="zip_code"]').val('');
                    $('#order-create-form [name="country"]').val('');

                    $('#allowed-shipping-methods').html('<i>Please enter an address</i>');
                    $('#allowed-shipping-methods').addClass('alert alert-danger');
                    $('#allowed-shipping-methods').show();
                    $('.temp').show().delay(2400).fadeOut('fast');
                    $('#address_info').slideDown('slow');

                    $('#address_box').find('.manualAddress').prop("checked", true);
                }     
                $('#address_title_box').fadeOut('fast')
            });

        });
        function fillAddress(){
            $.wait(function(){
                <?php if($loggedUser): ?>
                    $('.temp').show().delay(2400).fadeOut('fast');
                    $('#choose-shipping-country-first-template').html('');
                <?php endif; ?>
                if($('[name="address"]:checked').val() !== 'manual'){
                    var liAddressItem = $('[name="address"]:checked').parents('li.address-item');
                    $('#order-create-form [name="region"]').val(ShopCountries.getRegionFromCountry(liAddressItem.attr('data-country'))).change();
                    $('#order-create-form [name="city_state"]').val(liAddressItem.attr('data-city'));
                    $('#order-create-form [name="town"]').val(liAddressItem.attr('data-town'));
                    $('#order-create-form [name="address"]').val(liAddressItem.attr('data-address'));
                    $('#order-create-form [name="zip_code"]').val(liAddressItem.attr('data-zip_code'));
                    var setCountry = function(){
                        //$.wait(function(){
                            if($('#order-create-form [name="country"] option').length){
                                $('#order-create-form [name="country"]').val(liAddressItem.attr('data-country')).change();
                            }
                        //},1);
                    };
                    setCountry();
                }
            },0.5);
        }
        fillAddress();
        $('#addresses .address-item').on('click', function(){
            $(this).find('[name="address"]').first().prop("checked", true);
            fillAddress();

            if($('#address_info').is(':visible')){
                $('#address_info').slideUp('slow');
                $('#address_title_box').fadeIn(2400)
            }
        });
        $('#order-create-form').on('submit', function () {
            if($('[name="address"]:checked').val() === 'manual'){
                $('#order-create-form').validate();
                if (!$('#order-create-form').valid()) {
                    return false;
                }
            }        
            $('#order-create-form [type="submit"]').addClass('btn-loading');
            var courseOnly = parseInt($('#shop-cart-popup-content').data('courses-only'));
            if (!courseOnly) {
                var shippingMethod = $('[name="shipping_method"]').val();
                if (typeof shippingMethod === 'undefined')
                {
                    $('#allowed-shipping-methods').html('Please enter an address');
                    $('#allowed-shipping-methods').addClass('alert alert-danger');
                    $('#allowed-shipping-methods').show();
                    // $('#order-create-form .btn.ladda-button[type="submit"]').stop();
                    $('#order-create-form [type="submit"]').removeClass('btn-loading');
                    $('#phone').focus();
                    //$.wait(function () {
                        //$('#order-create-form .btn[type="submit"]').removeAttr('disabled');
                        //$('#order-create-form .btn[type="submit"]').removeAttr('data-loading');

                    //}, 2);
                    return false;
                }
                
            }
            var payment_method = $('[name="payment_method"]').val();
            if (typeof shippingMethod === 'undefined')
            {
                $('#allowed-shipping-methods').html('Please choose payment method');
                $('#allowed-shipping-methods').addClass('alert alert-danger');
                $('#allowed-shipping-methods').show();
                $('#order-create-form [type="submit"]').removeClass('btn-loading');
                return false;
            }
            var url = $('#order-create-form').attr('action');
            var data = $('#order-create-form').serialize();
            $.post(url, data).success(function (res) {
                if (res.redirect) {
                    window.location = res.redirect;
                }
            })
            .fail(function (res) {
                if (res.status === 422) {
                    NotificationDisplay.showErrorMessage(res.responseText);
                }
                $('#order-create-form [type="submit"]').removeClass('btn-loading');
            });
            ;
            return false;
        });

        var findRegion = function (country) {
            var _region = null;
            $.each(ShopCountries.countries, function (region, countries) {
                if (countries.indexOf(country) !== -1) {
                    _region = region;
                    return;
                }
            });
            return _region;
        };
        
        $('#zip_code').on('keyup', function (e) {
            this.value = this.value.toUpperCase();
        });
        
        
        
           var shippingAressVue =  new Vue({
            el : '#order-form-shipping-address',
            data : {
                showManuallyEnterAdressButton : true
            },
            methods : {
                showManuallyEnterAddress : function(){
                    this.showManuallyEnterAdressButton = false;
                    $('#address_info').show();
                },
                findAddress :  function () {
                    var postCode = $('#zip_code').val();
                    if (!postCode) {
                        NotificationDisplay.showErrorMessage("You must enter zipcode/postcode first");
                        return false;
                    }
                    var url = "{{url('shop/check-postcode')}}" + '/' + postCode;
                    this.showManuallyEnterAdressButton = false;
                    //$('.find-address').attr('disabled','disabled');
                    $('#zip_code').addClass('loading');
                    $.get(url)
                            .success(function (res) {
                                var country = res.country;
                                var region = findRegion(country);
                                var city = res.town;
                                var street = res.street;
                                var address = res.street;
                                if (country) {

                                    $('#order-create-form [name="region"]').val(region).change();
                                    try {
                                        $.wait(function () {
                                            $('#order-create-form [name="country"]').val(country).change();
                                            $.wait(function () {
                                               // $('#order-create-form [name="city_state"]').val(city);
                                                $('#order-create-form [name="address"]').val(address);
                                            }, 0.2);
                                        }, 0.2);
                                    } catch (ex) {
                                        console.log(ex);
                                    }
                                } else {
                                    $('#order-create-form [name="region"]').val('').change();
                                    $('#order-create-form [name="country"] option').remove();
                                    $('#order-create-form [name="city_state"]').val('');
                                    $('#order-create-form [name="address"]').val('');
                                    $('#order-create-form [name="country"]').attr('disabled', 'disabled');
                                }
                                $('#zip_code').removeClass('loading');

                            })
                            .error(function () {
                                $('#address_info').show();
                                $('#zip_code').removeClass('loading');
                                $('#order-create-form [name="region"]').val('').change();
                                $('#order-create-form [name="country"] option').remove();
                                $('#order-create-form [name="city_state"]').val('');
                                $('#order-create-form [name="address"]').val('');
                                $('#order-create-form [name="country"]').attr('disabled', 'disabled');
                                //$('#order-create-form [name="city_state"]').attr('disabled', 'disabled');
                            })
                            .done(function(){
                                $('.find-address').removeAttr('disabled');
                            });
                }
            }
        });
        
        $(document).on("keypress", '#discount_code', function (e) {
            var code = e.keyCode || e.which;
            if (code == 13) {
                e.preventDefault();
                return false;
            }
        });
        
        $('#zip_code').on('keypress', function (e) {
            if(e.which === 13){
                shippingAressVue.findAddress();
                return false;
            }
            this.value = this.value.toUpperCase();
        });
        <?php 
            $freeShipSetting = Modules\Shop\Models\Setting::where('key', 'uk_free_shipping')->first();
            $freeFee = $freeShipSetting ? $freeShipSetting->value : 0;
        ?>
       	
        // =================
        var orderSummary =  new Vue({
            el : '#shop-order-summary',
            data : {
                discount : @if(cart()->getDiscount()) {{\Modules\Shop\Cart::getCurrent()->discountTotal()}} @else 0 @endif,
                bagTotal : {{\Modules\Shop\Cart::getCurrent()->subTotal()}},
                redeemTotal: {{\Modules\Shop\Cart::getCurrent()->getRedeemTotal()}},
                delivery : 0,
                code : '',
                isEmpty : @if(cart()->isEmpty()) true @else false @endif ,
                countedTotal : 0,
                freeShippingUK : {{$freeFee }},
                defaultCountry:  "<?php echo ( auth()->user() ? ( auth()->user()->defaultAddress ? auth()->user()->defaultAddress->country : '' ) : ''); ?>"
            },
            created: function(){
                if(this.defaultCountry){
                    ShopShipping.getAllowedMethods(undefined, this.defaultCountry);
                }
                console.log(this.defaultCountry)
            },
            computed : {
                total : function(){
                    var _totalWithoutDiscount = this.bagTotal - this.discount - this.redeemTotal;
                    if(_totalWithoutDiscount < 0) {
                        _totalWithoutDiscount = 0;
                    } 
                    var _total = _totalWithoutDiscount + this.delivery;
                    _total = parseFloat(_total).toFixed(2);
                    return _total;
                }
            },
            methods : {
                applyDiscount : function(){
                	$('.temp').show().delay(2400).fadeOut('fast');
                    var data = {code : this.code};
                    var _this = this;
                    $.post("{{route('shop.discount.apply')}}",data)
                            .success(function(res){
                                ShopCart.refreshPopup();
                                _this.code = '';
                                var _discount = parseFloat(res.discount);
                                _discount = _discount.toFixed(2);
                                _this.discount = _discount;
                                var point = _discount * parseFloat($("#point_per_price").val()); 

                                $.wait(function(){
                                    var _totalWithoutDiscount = (parseFloat(_this.bagTotal) - parseFloat(res.discount));
                                    if(_totalWithoutDiscount < 0){
                                        _totalWithoutDiscount = 0;
                                    }
                                    _this.redeemTotal = parseFloat(res.redeem);
                                    _total = _totalWithoutDiscount + parseFloat(_this.delivery) - parseFloat(res.redeem);
                                    _total = (_total).toFixed(2);
                                    /*_total = parseFloat(res.total);
                                    _total = (_total).toFixed(2);*/
                                    _this.countedTotal = _total;

                                    // Update redeem value;
                                    var current_point = $("#shop-cart-summary-wraper #number_point").text();
                                    current_point = parseFloat(current_point);

                                    if (current_point > 0) {
                                        current_point += point;
                                        if (current_point < 0) {
                                            current_point = 0;
                                        }
                                        
                                        var current_price = $("#shop-cart-summary-wraper #number_price").text();
                                        current_price = parseFloat(current_price);
                                        current_price += parseFloat(_discount);
                                        if (current_price < 0) {
                                            current_price = 0;
                                        }
                                        
                                        var price_redeem = $("#shop-cart-summary-wraper #number_redeem").text();
                                        price_redeem = parseFloat(price_redeem);
                                        price_redeem -= parseFloat(_discount);
                                        if (price_redeem < 0) {
                                            price_redeem = 0;
                                        }

                                        current_price = (current_price > 0 ? current_price : 0);
                                        current_point = (current_point > 0 ? current_point : 0);

                                        if ($("#value-use-redeem").val() == 0 && current_point != "0") {
                                            $("#shop-cart-summary-wraper #number_point").text((current_point).toFixed(0));
                                            $("#shop-cart-summary-wraper #number_price").text((current_price).toFixed(2));
                                            $("#shop-cart-summary-wraper #number_redeem").text((price_redeem).toFixed(2));
                                        }

                                    }
                                    
                                    fillAddress();

                                    /*if($('#ship-to-country').val() === 'United Kingdom'){
                                        if(_this.freeShippingUK && parseFloat(_this.bagTotal) >= _this.freeShippingUK){
                                            ShopShipping.getAllowedMethods(initDelivery);
                                        }
                                    }*/
                                },1);
                            }).error(function(xhr){
                                NotificationDisplay.showErrorMessage(xhr.responseText);
                            }).complete(function(xhr){
                                
                            });
                },
                removeDiscount: function(discount){
                	$('.temp').show().delay(2400).fadeOut('fast');
                    var _this = this;
                    $.delete("{{route('shop.discount.remove')}}")
                            .success(function(){
                                ShopCart.refreshPopup();
                                // Update redeem value;
                                var current_point = $("#shop-cart-summary-wraper #number_point").text();
                                current_point = parseFloat(current_point);
                                
                                if (_this.redeemTotal > 0 && current_point > 0) {
                                	_this.redeemTotal = parseFloat(_this.redeemTotal) + parseFloat(_this.discount);
                                }
                                var _total = parseFloat(_this.bagTotal) - parseFloat(_this.redeemTotal) + parseFloat(_this.delivery);
                                _total = (_total).toFixed(2);
                                _this.countedTotal = _total > 0 ? _total : 0;
                                // Caculator point and price
                                var discount = parseFloat(_this.discount);
                                var point = discount * parseFloat($("#point_per_price").val()); 

                                _this.discount = 0;
                                _this.code = '';

                                // Update redeem value;
                                var current_point = $("#shop-cart-summary-wraper #number_point").text();
                                current_point = parseFloat(current_point);
                                
                                var current_price = $("#shop-cart-summary-wraper #number_price").text();
                                current_price = parseFloat(current_price);
                                
                                var price_redeem = $("#shop-cart-summary-wraper #number_redeem").text();
                                price_redeem = parseFloat(price_redeem);
                                
                                if (current_point > 0) {
                                	current_price -= discount;
                                	price_redeem += discount;
                                	current_point -= point;
                                }
                                current_price = (current_price > 0 ? current_price : 0);
                                current_point = (current_point > 0 ? current_point : 0);

                                if ($("#value-use-redeem").val() == 0 && current_point != "0") {
                                    $("#shop-cart-summary-wraper #number_point").text((current_point).toFixed(0));
                                    $("#shop-cart-summary-wraper #number_price").text((current_price).toFixed(2));
                                    $("#shop-cart-summary-wraper #number_redeem").text((price_redeem).toFixed(2));
                                } 
                                
                                fillAddress();
                                
                                /*
                                $.wait(function(){
                                    if($('#ship-to-country').val() === 'United Kingdom'){
                                        if(_this.freeShippingUK && parseFloat(_this.bagTotal) >= _this.freeShippingUK){
                                            ShopShipping.getAllowedMethods(initDelivery);
                                        }
                                    }
                                },1);*/

                            }).complete(function(xhr){
                                if (xhr.status == 400) {
                                    NotificationDisplay.showErrorMessage(xhr.responseText);
                                    return false;                                       
                                }
                            });
                },
                setDelivery : function(_delivery){
                    if (_delivery == 0) {
                        $('#delivery').hide();
                    } else {
                        $('#delivery').show();
                    }
                    _delivery =  parseFloat(_delivery); 
                    this.delivery = _delivery.toFixed(2);
                    var _total = (this.bagTotal - this.discount + _delivery - this.redeemTotal);
                    _total = parseFloat(_total).toFixed(2);
                    this.countedTotal = _total > 0 ? _total : 0 ;
                },
                removeItem : function(id,price){
                    var _this = this;
                    $('.cart-temp').show();
                    $.delete("{{url('shop/cart/items')}}"+'/'+id)
                            .success(function(res){
                                $('#cart-items-table tr[data-item-id="'+id+'"]').remove();
                                _this.discount = res.cart.discountTotal;
                                _this.bagTotal = parseFloat(_this.bagTotal) - parseFloat(price);
                                _this.bagTotal = _this.bagTotal.toFixed(2);
                                var _totalWithoutDiscount = (parseFloat(_this.bagTotal) - parseFloat(res.cart.discountTotal));
                                if(_totalWithoutDiscount < 0){
                                    _totalWithoutDiscount = 0;
                                }
                                var _total = _totalWithoutDiscount + parseFloat(_this.delivery);
                                _total = parseFloat(_total).toFixed(2);
                                _this.countedTotal = _total ;
                                ShopCart.refreshPopup();
                                if(!$('#cart-items-table tr').length){
                                    _this.isEmpty = true;
                                }
                                checkAndReloadShipping();
                                $('.cart-temp').hide();
                            });
                },
                goCheckout : function(){
                    if($('#address_info').is(':hidden') && $('[name="address"]:checked').val() === 'manual'){
                        NotificationDisplay.showErrorMessage("You must select an address or manually enter an address first");
                    }else{
                         
                    }
                },
            }
        });
        
        var initDelivery = function(){
            var fee = $('[name="shipping_method"]:checked').data('fee');
            if(typeof fee !== 'undefined'){
                orderSummary.setDelivery(fee);
            }
        };
        
        var checkAndReloadShipping = function(){
            if($('#ship-to-country').val()){
                ShopShipping.getAllowedMethods(initDelivery);
            }
        };

        // toggle for save address
        $(".save-address-box").hide();
        $(".save_address_question").click(function() {
            if($(this).is(":checked")) {
                $(".save-address-box").show();
            } else {
                $(".save-address-box").hide();
            }
        });
        
        
        $(document).on("click","#shop-cart-summary-wraper #use-redeem",function(){
            var redeem = '{{ \Cookie::get("redeem") }}';
            var use = $("#shop-cart-summary-wraper #value-use-redeem").val();
            $('.temp').show().delay(2400).fadeOut('fast');
            $.ajax({
                url : '{!! route("shop.carts.setredeem") !!}',
                type:"post",
                dataType:"json",
                data: {use : use},
                success:function(res){
                    console.log(res);
                    if (res["status"] == "success") {
                        var set_use = (use == 0) ? 1 : 0;
                        redeem = use;
                        if(redeem == 1){
                            $("#shop-cart-summary-wraper #lable-redeem").text("Cancel ");
                            $("#shop-cart-summary-wraper #total_redeem").show();
                            orderSummary.redeemTotal = parseFloat(res["price_redeem"]);
                            orderSummary.countedTotal = parseFloat(res["total_cart"]);
                        }else{
                            $("#shop-cart-summary-wraper #lable-redeem").text("");
                            $("#shop-cart-summary-wraper #total_redeem").hide();
                            $("#shop-cart-summary-wraper #number_redeem").val("0");
                            orderSummary.redeemTotal = 0;
                            orderSummary.countedTotal = parseFloat(res["total_cart"]);
                        }
                        orderSummary.countedTotal = parseFloat(orderSummary.countedTotal).toFixed(2);
                        
                        $("#shop-cart-summary-wraper #number_point").text(res["points"]);
                        $("#shop-cart-summary-wraper #number_price").text(res["rest_price"]);

                        $("#shop-cart-summary-wraper #number_redeem").text(res["price_redeem"]);
                        $("#shop-cart-summary-wraper #number_total").text(res["total_cart"]);
                        $("#shop-cart-summary-wraper #value-use-redeem").val(set_use);
                        $('.cart-temp').hide();
                        
                        fillAddress();
                        /*
                        $.wait(function(){
                            if($('#ship-to-country').val() === 'United Kingdom'){
                                if(_this.freeShippingUK && parseFloat(_this.bagTotal) >= _this.freeShippingUK){
                                    ShopShipping.getAllowedMethods(initDelivery);
                                }
                            }
                        },1);
                          */      
                    }else{
                        alert("Error!");
                    }
                    
                },error:function(){
                    alert("Error!");
                },complete: function () {
                	
                }
            })
        });
        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return false;
        }
    </script>
@stop