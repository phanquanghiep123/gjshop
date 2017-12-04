<?php

namespace App\Engine\Entity;

trait ParentChildSelfTrait {

    public function childs() {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')->where('status', 1)->orderBy('created_at', 'desc');;
    }
    
    public function parent() {
        return $this->belongsTo(__CLASS__, 'parent_id', 'id');
    }
    
    public function scopeRoot($query){
        return $query->where('parent_id', 0);
    }
    
    public function scopeChild($query){
        return $query->where('parent_id','!=', 0);
    }

}
