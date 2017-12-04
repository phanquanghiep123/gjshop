<?php
namespace App\Services\Authorization;

trait AuthorizationRoleTrait {
    
    public function permissions(){
        return $this->belongsToMany("\\App\\Permission");
    }
    
    public function users(){
        return $this->belongsToMany("\\App\\User");
    }
}