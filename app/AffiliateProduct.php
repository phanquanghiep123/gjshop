<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class AffiliateProduct extends Entity{
    
    const ACTIVE_STATUS = 1;
    const DEACTIVE_STATUS = 0;

    protected $fillable = [
        'type',
        'content_id',
        'product_name',
        'product_image',
        'product_link',
        'status',
    ];

    public function scopeActive($query){
        return $query->where('status', self::ACTIVE_STATUS);
    }

}
