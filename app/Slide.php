<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class Slide extends Entity{
    
    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $fillable = [
        'image',
        'caption',
        'caption_position',
        'caption_colour',
        'order',
        'status'
    ];

    public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }
}
