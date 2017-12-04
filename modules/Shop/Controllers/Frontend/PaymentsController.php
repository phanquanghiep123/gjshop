<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Illuminate\Http\Request;
use Modules\Shop\Models\Order;
use Modules\Shop\Controllers\Frontend\Payments\PaypalTrait;
use Modules\Shop\Controllers\Frontend\Payments\PaypalApiTrait;


/**
 * Description of PaymentsController
 *
 * @author dinhtrong
 */
class PaymentsController extends ShopController {
    
    protected $order;

    public function __construct(Order $order) {
        parent::__construct();
        $this->order = $order;
    }
    
    use PaypalTrait;
    
    public function cancel() {
        return response()->redirectToRoute('shop.cart.view');
    }

    public function success(Request $request) {
        
    }

    protected function getCancelUrl() {
        return route('shop.checkout.cancel');
    }
    
    protected function getPaymentDescription(){
        return "Payment description";
    }
    
    
}
