<?php

namespace Modules\Shop\Models;

/**
 * Description of ShippingMethods
 *
 * @author dinhtrong
 */
class StockNotificationEmail extends Model {

	const ACTIVE = 1;
    const INACTIVE = 0;
    
    protected $table = 'shop_stock_notification';
    
    protected $fillable = [
        'email','product_id','id','status','email_sent','user_id'
    ];


    public function product(){
        return $this->hasOne('\Modules\Shop\Models\Product', 'id', 'product_id');
    }
    
}
