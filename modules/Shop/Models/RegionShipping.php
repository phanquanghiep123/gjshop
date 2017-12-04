<?php


namespace Modules\Shop\Models;

/**
 * Description of RegionShipping
 *
 * @author dinhtrong
 */
class RegionShipping  extends Model{
    
    protected $table = "shop_region_shipping";
    
    protected $fillable = [
        'shop_shipping_method_id','region'
    ];


    public function shippingMethod(){
        return $this->belongsTo('\Modules\Shop\Models\ShippingMethod','shop_shipping_method_id');
    }
}
