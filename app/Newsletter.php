<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class Newsletter extends Entity{
    
    const ACTIVE = 1;
    const INACTIVE = 0;
    const CANELLED_STATUS = 3;

    protected $fillable = [
        'signup_name',
        'signup_email',
        'status'
    ];
    
    public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }
}
