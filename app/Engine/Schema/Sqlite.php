<?php

namespace App\Engine\Schema;

use App\Engine\Schema\Schema as AbSchema;
use App\Engine\Schema\Algorithm\Sqlite\DisableFKContraintAlgorithm;
use App\Engine\Schema\Algorithm\Sqlite\EnableFKContraintAlgorithm;

/**
 * Description of Sqlite
 *
 * @author dinhtrong
 */
class Sqlite extends AbSchema {
    
    public function __construct() {
        $this->setDisableFKContraintAlgorithm(new DisableFKContraintAlgorithm());
        $this->setEnableFKContraintAlgorithm(new EnableFKContraintAlgorithm());
    }

}
