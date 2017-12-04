<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploaderService {
    
    protected $file; // UploadedFile
    protected $dest; // FULL DEST PATH
    protected $fullUploadFilePath = NULL; // /home/dinhtrong/projectname/public/uploads/name.ext
    protected $fullUploadedFileName = NULL;

    public function __construct(UploadedFile $file,$dest = NULL) {
        $this->file = $file;
        $this->dest = $dest;
    }
    
    public function getFile() {
        return $this->file;
    }

    public function getDest() {
        return $this->dest;
    }

    public function setFile(UploadedFile $file) {
        $this->file = $file;
    }

    public function setDest($dest) {
        $this->dest = $dest;
    }
    
    public function upload(){
        $ext = $this->file->getClientOriginalExtension();
        $fileName = md5(microtime().uniqid('upload'));
        $fullFileName = $fileName . '.' . $ext;
        $this->file->move($this->dest,$fullFileName);
        $this->fullUploadedFileName = $fullFileName;
    }
    
    
    public function getFullUploadedFilePath(){
        return $this->dest .DIRECTORY_SEPARATOR . $this->fullUploadedFileName;
    }
    
    /*
    * @return /uploads/name.ext
    */
    public function getShortUploadedFilePath($cutFrom = NULL){
        if($cutFrom === NULL){
            $cutFrom = public_path();
        }
        return str_replace($cutFrom,'', $this->getFullUploadedFilePath());
    }
    
    /*
        some OS, DIRECTORY_SEPARATOR is \, so we must convert to / to use in url
    */
    public function getShortUploadedFileUri($cutFrom = NULL){
        $shortPath = $this->getShortUploadedFilePath($cutFrom);
        return str_replace(DIRECTORY_SEPARATOR, "/",$shortPath);
    }
    
}

