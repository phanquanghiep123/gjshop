<?php

namespace Modules\Shop\Models;

/**
 * Description of ShippingMethods
 *
 * @author dinhtrong
 */
class ProductReview extends Model {
    
    const APPROVED =  1;
    const PENDING = 0;

    protected $table = 'product_reviews';
    
    protected $fillable = [
        'name','user_id','email','rating','comment','status','product_id'
    ];


    public function scopeApproved($query) {
        return $query->where('status', self::APPROVED);
    }

    public function scopePending($query) {
        return $query->where('status', self::PENDING);
    }

    public function product()
	{
	    return $this->belongsTo('\Modules\Shop\Models\Product', 'id');
	}

    public function reviewer()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }
    
}
