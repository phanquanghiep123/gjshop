<?php

namespace Modules\Shop\ViewComposers;

use Illuminate\View\View;
use Modules\Shop\Models\ShippingMethod;
/**
 * Description of ShippingComposer
 *
 * @author dinhtrong
 */
class ShippingComposer {
    public function __construct(ShippingMethod $shipping) {
        $this->shippingMethod = $shipping;
    }
    public function compose(View $view){
        $view->with('count', $this->shippingMethod->count());
    }
}
