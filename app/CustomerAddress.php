<?php

namespace App;

/**
 * Description of Article
 *
 * @author dinhtrong
 */
class CustomerAddress extends Entity {

    const ACTIVE = 1;

    protected $guarded =  ['id'];

    public function scopeDefault($query){
        return $query->where('default', self::ACTIVE);
    }

}