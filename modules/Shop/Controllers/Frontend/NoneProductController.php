<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Illuminate\Http\Request;

/**
 * Description of NoneProductController
 *
 * @author dinhtrong
 */
class NoneProductController extends ShopController {

    public function removeCourse($courseId) {
        try {
            $cart = cart();
            $cart->removeCourse($courseId);
            $result = [
                'cart' => [
                    'isEmpty' => $cart->isEmpty(),
                    'total' => $cart->total(),
                    'quickViewHtml' => view('shop::_partials.cart.popupContent')->render(),
                    'countItems' => $cart->countItems(),
                ]
            ];
            return response()->json($result);
        } catch (\Modules\Shop\Exceptions\ItemNotAvailable $ex) {
            return response('Item is not availble',404);
        }
    }

}
