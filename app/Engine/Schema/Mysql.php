<?php

namespace App\Engine\Schema;

use App\Engine\Schema\Schema as AbSchema;
use App\Engine\Schema\Algorithm\Mysql\DisableFKContraintAlgorithm;
use App\Engine\Schema\Algorithm\Mysql\EnableFKContraintAlgorithm;

/**
 * Description of Mysql
 *
 * @author dinhtrong
 */
class Mysql extends AbSchema {
    
    public function __construct() {
        $this->setDisableFKContraintAlgorithm(new DisableFKContraintAlgorithm());
        $this->setEnableFKContraintAlgorithm(new EnableFKContraintAlgorithm());
    }

}
