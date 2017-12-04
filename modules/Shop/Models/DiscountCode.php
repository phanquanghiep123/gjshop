<?php

namespace Modules\Shop\Models;

/**
 * Description of DiscountCode
 *
 * @author dinhtrong
 */
class DiscountCode extends Model
{
    
    const TYPE_AMOUNT = 'amount';
    const TYPE_PERCENT = 'percent';
    const ACTIVE = '1';
    const COMMISSIONABLE = '1';
    
    protected $table = 'shop_discount_codes';
}
