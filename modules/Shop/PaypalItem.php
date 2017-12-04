<?php

namespace Modules\Shop;

use Omnipay\Common\Item;

/**
 * Description of PaypalItem
 *
 * @author dinhtrong
 */
class PaypalItem extends Item {
    public function getCode(){
        return uniqid('product');
    }
}
