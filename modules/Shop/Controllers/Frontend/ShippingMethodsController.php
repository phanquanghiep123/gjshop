<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Illuminate\Http\Request;
use Modules\Shop\CartSession;
use Modules\Shop\Models\ShippingMethod;

/**
 * Description of ShippingMethodsController
 *
 * @author dinhtrong
 */
class ShippingMethodsController extends ShopController
{

    protected $cartSession;
    protected $shippingMethod;

    public function __construct(ShippingMethod $shippingMethod)
    {
        parent::__construct();
        $this->cartSession = new CartSession();
        $this->shippingMethod = $shippingMethod;
    }

    public function getAllowedShippingMethods(Request $request)
    {
        $country = $request->input('country');
        $destination = 'RW';
        if ($country === 'United Kingdom') {
            $destination = 'UK';
        } elseif ($country === 'United States') {
            $destination = 'US';
        }
        cart()->setShipToCountry($destination);
        $shippingMethods = cart()->getAllowedShippingMethods();
        return view('shop::_partials.shippingMethods.list', ['shippingMethods' => $shippingMethods])->render();
    }
}
