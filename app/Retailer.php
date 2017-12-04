<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class Retailer extends Entity{
    
    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded = ['id'];

    public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }

    public function scopeDisplayed($query){
        return $query->where('status', self::ACTIVE)->where('displayed',1);
    }
}
