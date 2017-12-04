<?php

namespace Modules\Uploader;
use Illuminate\Support\Facades\Facade;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of Uploader
 *
 * @author dinhtrong
 */
class Uploader extends Facade {
    
    public function __construct() {
        ;
    }
    
    protected static function getFacadeAccessor() {
        return __CLASS__;
    }
    
    public function singleRender($name){
       echo view('uploader::_partials.single',  compact('name'))->render();
    }
}
