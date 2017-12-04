<?php

namespace App\Services\VideoShower;

/**
 * Description of VideoShowerService
 *
 * @author dinhtrong
 */
class VideoShowerService {
    
    protected $link;
    
    public function __construct($link) {
        $this->link = $link;
    }
    
    public function show(){
        $shower = null;
        if(preg_match("/^(https|http):\/\/www\.youtube\.com/",$this->link)){
            $shower = new YoutubeShower($this->link);
        }elseif(preg_match("/^(https|http):\/\/www\.vimeo\.com/",$this->link)){
            $shower = new VimeoShower($this->link);
        }
        if($shower){
            return $shower->show();
        }
    }
}
