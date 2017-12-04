<?php

namespace Modules\Shop\Models;

/**
 * Description of Setting
 *
 * @author dinhtrong
 */
class Setting extends Model {
    
    protected $table = 'shop_settings';
    
    protected $fillable = ['key','name','value'];
    
    public function findByKey($key){
        return $this->where('key',$key)->first();
    }
}
