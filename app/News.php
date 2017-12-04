<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class News extends Entity{
    
    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'list_image',
        'post_date',
        'status',
        'meta_keywords',
        'meta_description',
    ];


    public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }

}
