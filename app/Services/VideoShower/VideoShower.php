<?php

namespace App\Services\VideoShower;

use App\Services\VideoShower\Algorithm\IShowAlgorithm;

/**
 * Description of VideoShower
 *
 * @author dinhtrong
 */
abstract class VideoShower {
    
    
    protected $showAlgorithm;
    
    public function setShowAlgorithm(IShowAlgorithm $showAlgorithm) {
        $this->showAlgorithm = $showAlgorithm;
    }


    public function show(){
        $this->showAlgorithm->show();
    }
    
}
