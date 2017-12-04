<?php

namespace App;

/**
 * Description of Article
 *
 * @author dinhtrong
 */
class PostageRate extends Entity {

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $table =  'shop_shipping_methods';
    protected $guarded =  ['id'];

    public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }

    public function courier() {
        return $this->belongsTo('App\Courier', 'courier_id');
    }

}