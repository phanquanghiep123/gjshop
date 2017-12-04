<?php

namespace App;

use App\Services\Authorization\AuthorizationPermissionTrait;

/**
 * Description of Permission
 *
 * @author dinhtrong
 */
class Permission extends Entity {
    protected $fillable = [
        'name','slug','description','category_id'
    ];

    public function category() {
        return $this->belongsTo('App\PermissionCategory');
    }


    use AuthorizationPermissionTrait;
}
