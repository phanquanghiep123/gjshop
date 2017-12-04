<?php

namespace App\Services\Authorization;

trait AuthorizationUserOneRoleTrait {

    public function role() {
        return $this->belongsTo('\\App\\Role');
    }

}
