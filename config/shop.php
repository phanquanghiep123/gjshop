<?php

return [
    'layout' => 'layouts.frontend_shop',
    'layout_no_banner' => 'layouts.no_banner_shop',
    'product' => 'layouts.product',
    'cart' => 'layouts.cart',
    'backend_layout' => 'layouts.backend',
    'middleware' => ['web','cart-cookie'],
    'route_prefix' => 'shop',
    'braintree' => [
        'public_key' => '2xt68yx3gyk43dpg',
        'private_key' => '16b20f016ee9127a46c51498a8c9b701',
        'environment' => 'sandbox',
        'merchant_id' => 'kkgkcmw4twjnyc7x'
    ],
    'paypal' => [

         'username' => 'trandinhtrong-seller_api1.gmail.com',
         'password' => 'C8AMYDK27G5TC7UR',
         'signature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AKmMVxkJQemmYyiyIXSxwB2VEKAB',
         'sandbox' => true
    ],
    'currency_baseon_region' => false,
    'default_continent' => 'EU'
];



