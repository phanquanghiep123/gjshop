<?php

namespace Modules\Thumbnailer;

use File;
use Image;

/**
 * Description of Thumbnailer
 *
 * @author dinhtrong
 */
class Thumbnailer {
    
    private static $instance = NULL;
    private $tmpPath;
    
    private function __construct() {
        $this->tmpPath = public_path('.tmp');
        if(!File::exists($this->tmpPath)){
            File::makeDirectory($this->tmpPath,755);
        }
    }
    
    private function __clone() {
        ;
    }
    
    public static function getInstance(){
        if(self::$instance === NULL){
            self::$instance = new Thumbnailer();
        }
        return self::$instance;
    }

    public function generate($pathFromPublic, $width, $height = null) {
        $tmpFilePath = md5($pathFromPublic)."_{$width}x{$height}".$this->getExt($pathFromPublic);
        $filePath = $this->tmpPath .'/'.$tmpFilePath;
        if(!File::exists($filePath)){
            $thumbnail = Image::make($pathFromPublic);
            $thumbnail->fit($width, $height)->save($filePath);
        }
        return  '.tmp/' . $tmpFilePath;
    }
    
    public function remove($pathFromPublic){
        $tmpFilePathPattern = '/'.md5($pathFromPublic).'/';
        foreach(File::files($this->tmpPath) as $file ){
            $fileName = (string)$file;
            //echo ("compare $tmpFilePathPattern vs $file <br/>");
            if(preg_match($tmpFilePathPattern, $fileName)){
                File::delete($fileName);
            }
        }
    }
    
    private function getExt($pathFromPublic){
        $ext = '';
        if (preg_match('/.[a-zA-Z0-9_-]+$/',$pathFromPublic, $m)) {
            $ext =  isset($m[0]) ? $m[0] : '';
        }
        return $ext;
    }

}
