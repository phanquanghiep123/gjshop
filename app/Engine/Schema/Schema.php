<?php

namespace App\Engine\Schema;

use App\Engine\Schema\Algorithm\IDisableFKContraintAlgorithm;
use App\Engine\Schema\Algorithm\IEnableFKContraintAlgorithm;

/**
 *
 * @author dinhtrong
 */
abstract class Schema {
    
    protected $disableFKContraintAlgorithm;
    protected $enableFKContraintAlgorithm;
    
    public function setDisableFKContraintAlgorithm(IDisableFKContraintAlgorithm $disableFKContraintAlgorithm) {
        $this->disableFKContraintAlgorithm = $disableFKContraintAlgorithm;
    }

    public function setEnableFKContraintAlgorithm(IEnableFKContraintAlgorithm $enableFKContraintAlgorithm) {
        $this->enableFKContraintAlgorithm = $enableFKContraintAlgorithm;
    }
    
    public function disableFKContraint(){
        $this->disableFKContraintAlgorithm->disable();
    }
    
    public function enableFKContraint(){
        $this->enableFKContraintAlgorithm->enable();
    }

    
}
