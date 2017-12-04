<?php

namespace Modules\Shop\Models;

/**
 * Description of OrderTrait
 *
 * @author dinhtrong
 */
class Order extends Model {

    const INCOMPLETE_STATUS = 0;
    const PAYMENT_MADE_STATUS = 1;
    const SHIPPING_STATUS = 2;
    const COMPLETED_STATUS = 3;
    const CANCELLED_STATUS = 4;
    const REFUNDED_STATUS = 5;
    

    protected $table = 'shop_orders';
    protected $fillable = [
        'token', 'user_id', 'customer_name',
        'customer_phone', 'customer_address',
        'customer_state', 'customer_city','ship_date','tracked','email_shipped','email_cancelled','email_refunded',
        'customer_country', 'customer_note','discount','delivery','tracking_ref','order_number','courier',
        'price', 'ship_fee', 'taxt', 'payment_method', 'status', 'meta','voucher','admin_note','points_earned',
        'currency', 'items', 'zip_code','shipping_method_id','shipping_method_name','invoice_email','redeem','redeem_price','redeem_point','method_pay'
    ];
    protected $casts = [
        'meta' => 'array',
        'items' => 'array'
    ];

    public function scopeCompleted($query) {
        return $query->where('status', self::COMPLETED_STATUS);
    }
    
    public function shippingMethod(){
        return $this->belongsTo(ShippingMethod::class,'shipping_method_id');
    }

    public function scopeAwaitingPostage($query) {
        return $query->where('status', self::PAYMENT_MADE_STATUS);
    }

    
    
/*
    public function scopeWaiting($query) {
        return $query->where('status', self::WAITING_STATUS);
    }

    public function scopeCanceled($query) {
        return $query->where('status', self::CANCELED_STATUS);
    }
*/

}
