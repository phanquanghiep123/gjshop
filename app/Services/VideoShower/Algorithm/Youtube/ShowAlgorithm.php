<?php

namespace App\Services\VideoShower\Algorithm\Youtube;

use App\Services\VideoShower\Algorithm\IShowAlgorithm;
use App\Services\VideoShower\Helper;
/**
 * Description of Show
 *
 * @author dinhtrong
 */
class ShowAlgorithm implements IShowAlgorithm{
    
    protected $link;
    
    public function __construct($link) {
        $this->link = $link;
    }


    public function show() {
        $pattern = "/^(https|http):\/\/www\.youtube\.com\/watch\?v=([a-zA-Z0-9_]+)/";
        if(preg_match($pattern, $this->link,$m)){
            $id = $m[2];
            echo Helper::view(__DIR__.DIRECTORY_SEPARATOR.'view.php',['id'=>$id]);
        }
        
    }

}
