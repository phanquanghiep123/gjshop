<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Modules\Shop\Models;

/**
 * Description of CountryShipping
 *
 * @author dinhtrong
 */
class CountryShipping extends Model {
    
    protected $table = 'shop_country_shipping';
    
    protected $fillable = [
        'shop_shipping_method_id','country'
    ];
    
    public function shippingMethod(){
        return $this->belongsTo('\Modules\Shop\Models\ShippingMethod','shop_shipping_method_id');
    }
}
