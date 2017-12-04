<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username'    => env('PAYPAL_SANDBOX_API_USERNAME', 'phanquanghiep1234@gmail.com'),
        'password'    => env('PAYPAL_SANDBOX_API_PASSWORD', 'hiep123phan'),
        'secret'      => env('PAYPAL_SANDBOX_API_SECRET', 'EGQefgS9aS7KfQSUXFFzzbiLKDw-CzGqWSVWXR2-LM21txXXGnRN8jvV_47F-yBdCG5ecxT9GRnUJCnk'),
        'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
        'app_id'      => 'AammcDBGSHAWa4Fq3rkyACHJeOQlMNcy_VsuO12MhK3DcvE7uDzuXv7RAoJVOIypMSt5-9dnYbg2Nw-5', // Used for testing Adaptive Payments API in sandbox mode
    ],
    'live' => [
        'username'    => env('PAYPAL_LIVE_API_USERNAME', ''),
        'password'    => env('PAYPAL_LIVE_API_PASSWORD', ''),
        'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
        'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
        'app_id'      => '', // Used for Adaptive Payments API
    ],

    'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => 'USD',
    'notify_url'     => '', // Change this accordingly for your application.
    'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
];
