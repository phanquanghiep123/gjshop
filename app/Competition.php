<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class Competition extends Entity{
    
    const ACTIVE_STATUS = 1;
    const DEACTIVE_STATUS = 0;

    protected $fillable = [
        'name',
        'slug',
        'list_image',
        'image_alt',
        'bg_colour',
        'start_date',
        'end_date',
        'description',
        'winner',
        'country',
        'prize_image',
        'status',
    ];

    public function scopeActive($query){
        return $query->where('status', self::ACTIVE_STATUS);
    }

    public function scopePosted($query){
        return $query->where('status', self::ACTIVE_STATUS)->where('start_date','<=',date('Y-m-d'))->where('end_date','>=',date('Y-m-d'));
    }

}