<?php

namespace Modules\Media;

use File;
use Modules\Media\File as MediaFile;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Routing\UrlGenerator;

/**
 * Description of FileManager
 *
 * @author dinhtrong
 */
class FileManager {

    protected $path;
    protected $url;
    protected $config;
    
    public function __construct(ConfigRepository $config,  UrlGenerator $url,$path = null) {
        if ($path) {
            $this->path = $path;
        }
        $this->url = $url;
        $this->config = $config;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function listDirectories() {
        $return = [];
        $directories = File::directories($this->path);
        foreach ($directories as $dir) {
            $return[] = new Directory($this->config,$dir);
        }
        return $return;
    }

    public function listFiles() {
        $return = [];
        $files = File::files($this->path);
        foreach ($files as $file) {
            $return[] = new MediaFile($this->config,$this->url,$file);
        }
        return $return;
    }

}
