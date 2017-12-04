<?php

namespace App;

/**
 * Description of Article
 *
 * @author dinhtrong
 */
class Brand extends Entity {

    const ACTIVE = 1;
    const INACTIVE = 0;

    protected $guarded =  ['id'];

    public function scopeActive($query){
        return $query->where('status', self::ACTIVE);
    }

}