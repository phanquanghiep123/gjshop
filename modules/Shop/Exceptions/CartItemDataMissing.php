<?php

namespace Modules\Shop\Exceptions;

use Exception;

/**
 * Description of ItemCartDataMissing
 *
 * @author dinhtrong
 */
class CartItemDataMissing extends Exception {
    protected $message = "Missing Cart Item Data";
}
