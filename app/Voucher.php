<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class Voucher extends Entity{
    
    const ACTIVE = 1;
    const INACTIVE = 0;
    protected $table = 'shop_discount_codes';

    
    protected $guarded = ['id'];


    public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }

    public function creator() {
        return $this->belongsTo('App\User', 'created_by');
    }

    public function assignee() {
        return $this->belongsTo('App\User', 'assigned_to_user');
    }

}
