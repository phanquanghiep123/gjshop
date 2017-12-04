<?php


namespace App\Services\VideoShower;

/**
 * Description of YoutubeShower
 *
 * @author dinhtrong
 */
class YoutubeShower extends VideoShower {
    public function __construct($link) {
        $this->setShowAlgorithm(new Algorithm\Youtube\ShowAlgorithm($link));
    }
}
