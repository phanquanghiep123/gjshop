if (typeof getParameterByName === 'undefined' || !$.isFunction(getParameterByName)) {
    function getParameterByName(name, url) {
        if (!url)
            url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
                results = regex.exec(url);
        if (!results)
            return null;
        if (!results[2])
            return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
}

var ShopDisplay = ShopDisplay || {};

ShopDisplay.showSuccessMessage = function (message) {
    noty({
        layout: 'topCenter',
        theme: 'relax', // or 'relax'
        type: 'success',
        text: message,
        timeout: 7000,
        animation: {
            // open: 'animated bounceInLeft', // Animate.css class names
            // close: 'animated bounceOutRight', // Animate.css class names
            open: 'animated fadeInDown', // Animate.css class names
            close: 'animated fadeOutUp', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        }
    });
};

ShopDisplay.showErrorMessage = function (error) {
    var message = '';
    try {
        var errorsAsJson = JSON.parse(error);
        $.each(errorsAsJson, function (index, value) {
            message += (value + '<br/>');
        });
    } catch (e) {
        message = error;
    }
    noty({
        layout: 'topCenter',
        theme: 'relax', // or 'relax'
        type: 'error',
        text: message,
        timeout: 7000,
        animation: {
            // open: 'animated bounceInLeft', // Animate.css class names
            // close: 'animated bounceOutRight', // Animate.css class names
            open: 'animated fadeInUp', // Animate.css class names
            close: 'animated fadeOutDown', // Animate.css class names
            easing: 'swing', // unavailable - no need
            speed: 500 // unavailable - no need
        }
    });
};

var ShopCart = ShopCart || {};

ShopCart.updateQuantity = function (dom) {
    var quantity = $(dom).val();
    if (quantity <= 0) {
        $(dom).val(1);
    } else {
        var data = {
            id: $(dom).data('id'),
            quantity: quantity
        };
        $.put(baseUrl + '/shop/cart/update', data, function (res) {
            $(dom).parents('tr').find('.sub-total').html(res.itemSubtotal);
            $('#cart-total').html(res.total);
            $('#discount-amount').html(res.discountTotal);
            $('#sub-total').html(res.subTotal);
            $('#shop-cart-popup-wraper .shop-cart-popup').html(res.quickViewHtml);
            $('#shop-cart-number-items,.cart-item-couter').html(res.countItems);
        });
    }
};

ShopCart.removeItem = function (form) {
    var url = $(form).attr('action');
    $('.temp').fadeIn();
    $.ajax({
        url: url,
        type: "POST",
        data: {_method: "DELETE"},
        success: function (res) {
            if (res.cart.isEmpty) {
                $('#cart-empty-row').show();
                $('#cart-nonempty-row').hide();
                var counterParent = $('#shop-cart-number-items').parent();
                if (counterParent.hasClass('icon-basket-loaded')) {
                    counterParent.addClass('icon-basket');
                    counterParent.removeClass('icon-basket-loaded');
                }
                $('#shop-cart-number-items').html('');
            } else {
                $(form).parents('tr').remove();
                $('#cart-total').text(res.cart.total);
                $('#shop-cart-number-items,.cart-item-couter').html(res.cart.countItems);
                $('#car-bottom-form').html(res.cart.cartFormContent);
            }
            $('.temp').fadeOut('fast');
            $('#shop-cart-popup-wraper .shop-cart-popup').html(res.cart.quickViewHtml);
        }
    });
};


ShopCart.quickRemove = function (link) {
    var url = $(link).data('url');
    var itemName = $(link).parent('td').find('a').first().attr('title');
    $.delete(url, [], function (res) {
        if (res.cart.isEmpty) {
            var counterParent = $('#shop-cart-number-items').parent();
            if (counterParent.hasClass('icon-basket-loaded')) {
                counterParent.addClass('icon-basket');
                counterParent.removeClass('icon-basket-loaded');
            }
            $('#shop-cart-number-items').html('');
        } else {
            $('#shop-cart-number-items,.cart-item-couter').html(res.cart.countItems);
        }
        $('#shop-cart-popup-wraper .shop-cart-popup').html(res.cart.quickViewHtml);
        $('#shop-cart-summary-wraper .shop-cart-summary').html(res.cart.orderSummaryHtml);
        ShopDisplay.showSuccessMessage(itemName + ' was successfully removed from your bag!');
        if ($('#allowed-shipping-methods').length) {
            ShopShipping.getAllowedMethods();
        }
    });
};

ShopCart.addItem = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $('.temp').fadeIn('fast');
    $.post(url, data, function (res) {


        $('#shop-cart-number-items').html(res.countItems);
        $('#shop-cart-popup-wraper .shop-cart-popup').html(res.quickViewHtml);
        var counterParent = $('#shop-cart-number-items').parent();
        var productName = $(form).find('input[name="product_name"]').val();
        if (counterParent.hasClass('icon-basket')) {
            counterParent.removeClass('icon-basket');
            counterParent.addClass('icon-basket-loaded');
        }
        var messageExist = false;
        var message = productName + ' has been successfully added to your bag!';
        var existNoty = $('.noty_bar.noty_type_success .noty_text');

        if (existNoty.height()) {
            existNoty.each(function () {
                console.log(this);
                if ($(this).html() === message) {
                    messageExist = true;
                }
            });

        }
        if (!messageExist) {
            ShopDisplay.showSuccessMessage(message);
        }
        $('#shop-cart-popup-wraper').tooltip({
            selector: '[data-toggle="tooltip"]'
        });

        $('.temp').fadeOut('fast');


    });
};

ShopCart.applyDiscount = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $.post(url, data, function (res) {
        $('#car-bottom-form').html(res.cartContent);
        ShopCart.refreshPopup();
    }).fail(function (error) {
        ShopDisplay.showErrorMessage(error.responseText);
    });
};

ShopCart.removeDiscount = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $.delete(url, data, function (res) {
        $('#car-bottom-form').html(res);
        ShopCart.refreshPopup();
    }).fail(function (error) {
        ShopDisplay.showErrorMessage(error.responseText);
    });
};

ShopCart.refreshPopup = function () {
    $.get(baseUrl + '/shop/cart/refresh-popup-content')
            .success(function (res) {
                $('#shop-cart-popup-wraper .shop-cart-popup').html(res.popup);
                if(res.number_of_items){
                    $('#shop-cart-number-items').text(res.number_of_items);
                }else{
                    $('#shop-cart-number-items').text('');
                }
                
            });
};

var ShopOrder = ShopOrder || {};

ShopOrder.checkCreateAccount = function (cb) {
    if ($(cb).is(':checked')) {
        $('#create-account-password-wrapper').show();
        $('#order-create-form [name="password"]').attr('required', 'required');
        $('#order-create-form [name="confirm_password"]').attr('required', 'required');
        $('#order-create-form [name="confirm_password"]').attr('data-rule-equalTo', '#create-account-password');
        $('#order-create-form [name="confirm_password"]').attr('data-msg-equalto', 'Password does not match the confirm password');
    } else {
        $('#create-account-password-wrapper').hide();
        $('#order-create-form [name="password"]').removeAttr('requried');
        $('#order-create-form [name="confirm_password"]').removeAttr('required');
        $('#order-create-form [name="confirm_password"]').removeAttr('data-rule-equalto');
        $('#order-create-form [name="confirm_password"]').removeAttr('data-msg-equalto');
    }
};

var ShopProduct = ShopProduct || {};

ShopProduct.changeGalleryImage = function (img) {
    var src = $(img).attr('data-src');
    $('#detail-product .main img').attr('src', src);
};

ShopProduct.addFavorites = function (link) {

    var url = $(link).data('url');
    var id = $(link).data('id');
    $.post(url, {product_id: id}, function (success) {
        ShopDisplay.showSuccessMessage(success.message);
        ShopProduct.loadFavorites(1);
    }).error(function (res) {
        if (res.status === 422) {
            ShopDisplay.showErrorMessage(res.responseText);
        }
    });

};

ShopProduct.rebindRemoveFavoritesTooltips = function () {
    $('#user-favorite-products').tooltip({
        selector: '[data-toggle="tooltip"]'
    });
};

ShopProduct.loadFavorites = function (page) {
    $.get(baseUrl + '/shop/favorite-products?page=' + page, function (html) {
        $('#user-favorite-products').html(html);
        setTimeout(function () {
            ShopProduct.rebindRemoveFavoritesTooltips();
        }, 500);
    });
};
$('#user-favorite-products').on('click', '.pager li a', function () {
    var link = $(this).attr('href');
    var page = getParameterByName('page', link);
    ShopProduct.loadFavorites(page);
    return false;
});

ShopProduct.deleteFavorite = function (link) {
    var url = $(link).data('url');
    $.delete(url, [], function (res) {
        ShopDisplay.showSuccessMessage(res.message);
        ShopProduct.loadFavorites(1);
    });
};

var ShopSubscription = ShopSubscription || {};

ShopSubscription.subscribeStockDelivered = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $.post(url, data, function (res) {
        $('.formStockNotifications').each(function () {
            this.reset();
        });

        ShopDisplay.showSuccessMessage(res.message);
    }).error(function (res) {
        if (res.status === 422) {
            ShopDisplay.showErrorMessage(res.responseText);
        }
    });
};

ShopSubscription.bindHanldelSubscribeStockDeliveredTooltip = function () {
    $('.category-products .product .productListInstockEmail').on('click', function () {
        var popover = $(this).parent().find('.popover');
        if (popover.hasClass('in')) {
            popover.removeClass('in');
            popover.addClass('out');
        } else {
            popover.removeClass('out');
            popover.addClass('in');
        }
        $('.category-products .product .productListInstockEmail').not(this).each(function () {
            var otherPopover = $(this).parent().find('.popover-subscription');
            otherPopover.removeClass('in');
            otherPopover.addClass('out');
        });
        $('.category-products .product .producFavoriteLogin').each(function () {
            var otherPopover = $(this).parent().find('.popover-login');
            otherPopover.removeClass('in');
            otherPopover.addClass('out');
        });

        var productDom = $(this).parents('.product');
        $('#stockNotification-modal .product-image').attr('src', productDom.find('.product-image').attr('src'));
        $('#stockNotification-modal .product-name').text(productDom.find('.listProductName a').text());
    });

    $('.category-products .product .producFavoriteLogin').on('click', function () {

        var popover = $(this).parent().find('.popover');
        if (popover.hasClass('in')) {
            popover.removeClass('in');
            popover.addClass('out');
        } else {
            popover.removeClass('out');
            popover.addClass('in');
        }
        $('.category-products .product .producFavoriteLogin').not(this).each(function () {
            var otherPopover = $(this).parent().find('.popover-login');
            otherPopover.removeClass('in');
            otherPopover.addClass('out');
        });
        $('.category-products .product .productListInstockEmail').each(function () {
            var otherPopover = $(this).parent().find('.popover-subscription');
            otherPopover.removeClass('in');
            otherPopover.addClass('out');
        });
    });


};

var ShopShipping = ShopShipping || {};
ShopShipping.getAllowedMethods = function (callback, country) {
    var url = baseUrl + '/shop/allowed-shipping-methods';
    if(typeof country === 'undefined'){
        country = $('#ship-to-country').val();
    }
    //console.log(country); // to test
    if (country) {
        var data = {country: country};
        $('.temp').show().delay(2400).fadeOut('fast');
        $.get(url, data, function (html) {
        	if (html.indexOf("text-danger") !== -1) {
        		orderSummary.setDelivery(0);
        		$('#allowed-shipping-methods').addClass('alert alert-danger');
        	} else {
        		$('#allowed-shipping-methods').removeClass('alert alert-danger');
        	}
	        if ($.trim(html) == '') {
	        	$('#allowed-shipping-methods').hide();
	    	} else {
	    		$('#allowed-shipping-methods').show();
	    	}
            $('#allowed-shipping-methods').html(html);
            if (typeof callback !== 'undefined') {
                $.wait(function () {
                    callback();
                },0.5);
            }

        });
    }

}
ShopShipping.reset = function () {
	//var tmp = $('#choose-shipping-country-first-template').html();
    //$('#allowed-shipping-methods').html(tmp);
};
var ShopSetting = ShopSetting || {};
ShopSetting.saveCurrencyCookie = function (form) {

};
/*
 $('body').on('click', function (e) {
 $('[data-toggle="popover"]').each(function () {
 //the 'is' for buttons that trigger popups
 //the 'has' for icons within a button that triggers a popup
 if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
 $(this).popover('hide');
 }
 });
 });
 $('body').on('hover', function (e) {
 $('[data-toggle="tooltip"]').each(function () {
 //the 'is' for buttons that trigger popups
 //the 'has' for icons within a button that triggers a popup
 if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.tooltip').has(e.target).length === 0) {
 $(this).tooltip('hide');
 }
 });
 });
 */
// autorun
ShopSubscription.bindHanldelSubscribeStockDeliveredTooltip();
ShopProduct.submitReview = function (form) {
    var url = $(form).attr('action');
    var data = $(form).serialize();
    $.post(url, data, function (res) {
        document.getElementById("submitReview").reset();
        ShopDisplay.showSuccessMessage(res.message);
    }).error(function (res) {
        if (res.status === 422) {
            ShopDisplay.showErrorMessage(res.responseText);
        }
    });
};
