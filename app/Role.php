<?php

namespace App;

use App\Services\Authorization\AuthorizationRoleTrait;

/**
 * Description of Role
 *
 * @author dinhtrong
 */
class Role extends Entity {
    
    protected $fillable = [
        'name','slug','description'
    ];
    
    use AuthorizationRoleTrait;
}
