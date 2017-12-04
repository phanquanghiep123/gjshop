<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class Quote extends Entity{
    
    const ACTIVE_STATUS = 1;
    const DEACTIVE_STATUS = 0;

    protected $fillable = [
        'author',
        'quote',
        'category_id',
        'status'
    ];

    public function category() {
        return $this->belongsTo('\App\Category');
    }
    public function scopeActive($query){
        return $query->where('status', self::ACTIVE_STATUS);
    }
}
