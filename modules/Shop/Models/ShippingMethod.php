<?php

namespace Modules\Shop\Models;

use Modules\Shop\Cart;

/**
 * Description of ShippingMethods
 *
 * @author dinhtrong
 */
class ShippingMethod extends Model
{

    const ACTIVED_STATUS = 1;
    const DEACTIVED_STATUS = 0;
    const FREE_METHOD_ID = 0;
    const FREE_METHOD_NAME = 'Free shipping';

    protected $casts = [
        'meta' => 'array', 'fee_rates' => 'array'
    ];
    protected $table = 'shop_shipping_methods';
    protected $fillable = [
        'name', 'fee_rates', 'status', 'meta', 'origin', 'destination',
        'min_weight', 'max_weight', 'type', 'fee', 'service', 'size'
    ];

    public function scopeActive($query) {
        return $query->where('status', self::ACTIVED_STATUS);
    }

    public function getFeeBaseOnContinentFormated(Cart $cart)
    {
        $continent = $cart->getContinent();
        if ($continent === 'EU') {
            return '£' . number_format($this->fee, 2);
        } else {
            return '$' . number_format($this->fee, 2);
        }
    }

    public static function createFreeShippingMethod()
    {
        $freeMethod = new ShippingMethod;
        $freeMethod->name = ShippingMethod::FREE_METHOD_NAME;
        $freeMethod->fee = 0;
        $freeMethod->id = ShippingMethod::FREE_METHOD_ID;
        return $freeMethod;
    }
}
