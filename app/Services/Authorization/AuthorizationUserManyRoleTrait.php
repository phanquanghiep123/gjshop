<?php

namespace App\Services\Authorization;

trait AuthorizationUserManyRoleTrait {
    public function roles(){
        return $this->belongsToMany("\\App\\Role");
    }
    
    public function is($role){
        foreach ($this->roles as $userRole){
            if($userRole->name == $role || $userRole->slug == $role){
                return true;
            }
        }
        return false;
    }
    
    public function canDo($permission){
        foreach ($this->roles as $role){
            foreach ($role->permissions as $p){
                if($p->slug == $permission){
                    return true;
                }
            }
        }
        return false;
    }
}