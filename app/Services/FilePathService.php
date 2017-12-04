<?php

namespace App\Services;

class FilePathService {
    /*
    @param : 
        - $path : string  (thisis/part/of/11)
    @return : full path that be created
    */
    public static function createDirFromPublic($path){
        $dirs = explode("/",$path);
        $currentDir = public_path();
        foreach ($dirs as $dir){
            if($dir !== ''){
                $currentDir .= DIRECTORY_SEPARATOR .$dir;
                if(!\File::exists($currentDir)){
                    \File::makeDirectory($currentDir);
                }
            }
        }
        return $currentDir;
    }
}
