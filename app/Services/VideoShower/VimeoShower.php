<?php

namespace App\Services\VideoShower;

/**
 * Description of VimeoShower
 *
 * @author dinhtrong
 */
class VimeoShower extends VideoShower{
    
    public function __construct($link) {
        $this->setShowAlgorithm(new Algorithm\Vimeo\ShowAlgorithm($link));
    }
    
}
