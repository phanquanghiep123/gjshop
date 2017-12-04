<?php

namespace App\Services\Authorization;

trait AuthorizationPermissionTrait {
    public function roles(){
        return $this->belongsToMany("\\App\\Role");
    }
}