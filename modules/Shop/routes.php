<?php
$middleware = config('shop.middleware');

$group = [];
$group['prefix'] = 'shop';
if ($middleware) {
    $group['middleware'] = $middleware;
}

Route::group($group, function () {
    Route::pattern('slug', '[a-zA-Z0-9-_]+');
    Route::pattern('parentSlug', '[a-zA-Z0-9-_]+');
    Route::get('/', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CategoriesController@lists',
        'as' => 'shop.categories.lists'
    ]);

    Route::get('allowed-shipping-methods', [
        'uses' => '\Modules\Shop\Controllers\Frontend\ShippingMethodsController@getAllowedShippingMethods',
        'as' => 'shop.getAllowedShippingMethods'
    ]);

    Route::post('choose-continent', [
        'uses' => '\Modules\Shop\Controllers\Frontend\SettingsController@setContinent',
        'as' => 'shop.chooseContinent'
    ]);

    Route::post('/favorite-products', [
        'uses' => '\Modules\Shop\Controllers\Frontend\FavoriteProductsController@add',
        'as' => 'shop.favorites.store'
    ]);

    Route::get('/favorite-products', [
        'uses' => '\Modules\Shop\Controllers\Frontend\FavoriteProductsController@index',
        'as' => 'shop.favorites',
    ]);

    Route::delete('/favorite-products/{id}', [
        'uses' => '\Modules\Shop\Controllers\Frontend\FavoriteProductsController@delete',
        'as' => 'shop.favorites.delete'
    ]);


    Route::get('/categories/{slug}', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CategoriesController@listChildCategory',
        'as' => 'shop.categories.listChildCategory'
    ]);
    Route::get('/category/{slug}', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CategoriesController@showChildCategory',
        'as' => 'shop.categories.showChildCategory'
    ]);

    Route::get('/product/search', [
        'uses' => '\Modules\Shop\Controllers\Frontend\ProductsController@search',
        'as' => 'shop.products.search'
    ]);


    Route::get('/product/{slug}', [
        'uses' => '\Modules\Shop\Controllers\Frontend\ProductsController@show',
        'as' => 'shop.products.show'
    ]);

    Route::get('/cart', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CartsController@view',
        'as' => 'shop.cart.view'
    ]);

    Route::post('/cart', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CartsController@add',
        'as' => 'shop.cart.add'
    ]);

    Route::post('/cart/quickbuy', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CartsController@quickBuy',
        'as' => 'shop.cart.quickBuy'
    ]);

    Route::put('/cart/update', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CartsController@update',
        'as' => 'shop.cart.update'
    ]);

    Route::delete('/cart/items/{id}', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CartsController@removeItem',
        'as' => 'shop.cart.removeItem'
    ]);
    
    Route::get('/cart/refresh-popup-content', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CartsController@getPopupContent',
        'as' => 'shop.cart.refreshPopupContent'
    ]);

    Route::get('/order/create', [
        'uses' => '\Modules\Shop\Controllers\Frontend\OrderController@create',
        'as' => 'shop.order.create'
    ]);
    
    Route::post('/carts/setredeem', [
        'uses' => '\Modules\Shop\Controllers\Frontend\CartsController@setredeem',
        'as' => 'shop.carts.setredeem'
    ]);

    Route::post('/order', [
        'uses' => '\Modules\Shop\Controllers\Frontend\OrderController@store',
        'as' => 'shop.order.store'
    ]);

    Route::get('/checkout/paypal', [
        'uses' => '\Modules\Shop\Controllers\Frontend\PaymentsController@checkoutWithPaypal',
        'as' => 'shop.checkout.paypal'
    ]);

    Route::get('/checkout/stripe', [
        'uses' => '\Modules\Shop\Controllers\Frontend\PaymentsController@checkoutWithStripe',
        'as' => 'shop.checkout.stripe'
    ]);

    Route::get('/checkout/cancel', [
        'uses' => '\Modules\Shop\Controllers\Frontend\PaymentsController@cancel',
        'as' => 'shop.checkout.cancel'
    ]);

    Route::pattern('order', '[a-zA-Z0-9]+');
    Route::get('/checkout/stripe-return/{order}', [
        'uses' => '\Modules\Shop\Controllers\Frontend\PaymentsController@getStripeCheckoutReturn',
        'as' => 'shop.checkout.stripe_return'
    ]);
    Route::get('/checkout/paypal-return/{order}', [
        'uses' => '\Modules\Shop\Controllers\Frontend\PaymentsController@getPaypalCheckoutReturn',
        'as' => 'shop.checkout.paypal_return'
    ]);
    Route::post('delete-order/{id}', [
        'uses' => '\Modules\Shop\Controllers\Frontend\OrderController@delete_order',
        'as' => 'shop.order.delete'
    ]);

    Route::post('/setting/currency', [
        'uses' => '\Modules\Shop\Controllers\Frontend\SettingsController@saveCurrencyCookie',
        'as' => 'shop.settings.saveCurrencyCookie'
    ]);


    Route::post('/add-review', [
        'uses' => '\Modules\Shop\Controllers\Frontend\ProductsController@addReview',
        'as' => 'shop.review.add'
    ]);

    Route::post('subscriptions/subscribe-stock-delivered', [
        'uses' => '\Modules\Shop\Controllers\Frontend\SubscriptionsController@subscribeStockDelivered',
        'as' => 'shop.subscriptions.subscribeStockDelivered'
    ]);
/*
    Route::group(['middleware' => ['auth']], function() {
        Route::get('order-history', ['uses' => '\Modules\Shop\Controllers\Frontend\OrderController@viewHistory',
            'as' => 'viewHistory']);  // need to make sure the user is logged in
    });

    Route::group(['middleware' => ['auth']], function() {
        Route::get('order-{slug}', ['uses' => '\Modules\Shop\Controllers\Frontend\OrderController@orderDetails',
            'as' => 'viewOrderDetails']);  // need to make sure the user is logged in
    });
*/
    Route::post('order/tmp', [
        'uses' => '\Modules\Shop\Controllers\Frontend\OrderController@saveTmp',
        'as' => 'shop.order.saveTmp'
    ]);

    Route::post('discount', [
        'uses' => '\Modules\Shop\Controllers\Frontend\DiscountController@apply',
        'as' => 'shop.discount.apply'
    ]);
    
    Route::delete('discount', [
        'uses' => '\Modules\Shop\Controllers\Frontend\DiscountController@remove',
        'as' => 'shop.discount.remove'
    ]);
    
    
    Route::get('check-postcode/{postCode}', [
        'uses' => '\Modules\Shop\Controllers\Frontend\OrderController@checkPostcode',
        'as' => 'shop.check_postcode'
    ]);


    Route::post('convert-points', [
        'uses' => '\Modules\Shop\Controllers\Frontend\PointsController@convert',
        'as' => 'convert_points'
    ]);
    
});


$adminMiddleware = $middleware;
$adminMiddleware[] = 'admin';
Route::group(['prefix' => 'gjadmin/shop', 'middleware' => $adminMiddleware], function () {
    Route::resource('productcategories', 'Modules\Shop\Controllers\Backend\ProductCategoriesController');
    Route::resource('products', 'Modules\Shop\Controllers\Backend\ProductsController');
    Route::resource('orders', 'Modules\Shop\Controllers\Backend\OrdersController');
    Route::get('settings', [
        'uses' => 'Modules\Shop\Controllers\Backend\SettingsController@getSettings',
        'as' => 'gjadmin.shop.getSettings'
    ]);
    Route::post('settings', [
        'uses' => 'Modules\Shop\Controllers\Backend\SettingsController@saveSettings',
        'as' => 'gjadmin.shop.saveSettings'
    ]);
});

