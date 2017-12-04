<?php

namespace App\Services;

use Illuminate\Filesystem\Filesystem;

/**
 * Description of DuplicationFileByRenameService
 *
 * @author dinhtrong
 */
class DuplicateFileByRenameService {
    
    protected $file;
    
    public function __construct(Filesystem $file) {
        $this->file = $file;
    }
    
    /*
     * @input : 
     *  directory : /full/path/of/dir
     *  fileName :  filename.ext  -- will be saved in to directory 
     * @return string fileName: if file exist, add number as suffix
     *           for examle : directory have these files: a.jpg,a_1.jpg,b.jpg,c.jpg
     *              - upload a.jpg => right name is a_2.jpg
     *              - upload b.jpg => right name is b_2.jpg
     */
    public function getRightFullname($directory, $fileName) {
        $fileName = self::cleanString($fileName);
        $onlyName = pathinfo($fileName, PATHINFO_FILENAME);
        $onlyExt = str_replace($onlyName . '.', '', $fileName);
        return self::getSavedFileName($this->file,$directory, $fileName, $onlyName, $onlyExt);
    }

    protected static function cleanString($string) {
        $withHyphens = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $noSpecial = preg_replace('/[^A-Za-z0-9\-\._]/', '', $withHyphens); // Removes special chars.
        return preg_replace('/-+/', '-', $noSpecial); // Replaces multiple hyphens with single one.
    }

    protected static function getSavedFileName($fileSystem,$directory, $fileName,$onlyName, $ext) {

        if ($fileSystem->exists($directory . '/' . $fileName)) {
            // var_dump("$fileName exist"); for test
            if (preg_match('/_[0-9]+$/', $onlyName, $m)) {
                $next = intval(str_replace("_", "", $m[0])) + 1;
                $ultimateName = preg_replace('/[0-9]+$/', $next, $onlyName);
            } else {
                $ultimateName = $onlyName . '_1';
            }
            $ultimateName = self::cleanString($ultimateName);
            $ultimateNameWithExt = $ext ? $ultimateName . "." . $ext : $ultimateName;
            return self::getSavedFileName($fileSystem,$directory, $ultimateNameWithExt,$ultimateName, $ext);
        } else {
            $validName = self::cleanString($onlyName);
            return $ext ? $validName . '.' . $ext : $validName;
        }
    }

}
