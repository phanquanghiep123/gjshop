<?php

namespace Modules\Shop\Models;

/**
 * Description of ShippingMethods
 *
 * @author dinhtrong
 */
class Certificate extends Model {
    
    protected $table = 'certificates';
    
    protected $guarded = ['id'];



    public function products() {
        return $this->belongsToMany('\Modules\Shop\Models\Product','shop_product_certificates','certificate_id','product_id');
    }
    
}
