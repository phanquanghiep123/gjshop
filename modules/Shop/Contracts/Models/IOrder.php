<?php

namespace Modules\Shop\Contracts\Models;

/**
 *
 * @author dinhtrong
 */
interface IOrder {
    const WAITING_STATUS = 0;
    const COMPLETED_STATUS = 1;
    const CANCELED_STATUS = 2;
}
