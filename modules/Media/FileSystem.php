<?php

namespace Modules\Media;

use Illuminate\Config\Repository as ConfigRepository;

/**
 * Description of FileSystem
 *
 * @author dinhtrong
 */
class FileSystem {

    protected $path;
    protected $sortPath;
    protected $name;
    protected $basePath;
    protected $config; //Illuminate\Config\Repository
    protected $modified;


    public function __construct( ConfigRepository $config,$path) {
        
        $this->path = $path;
        $this->config = $config;
        $this->basePath = $this->config->get('media.base_path');
        
        $patterns = [
            0 => "/" . str_replace("/", "\/", $this->basePath) . "/",
            1 => "/\/\//"
        ];
        $replacements = [
            0 => '',
            1 => '/'
        ];
        $this->sortPath = preg_replace($patterns, $replacements, $path);
        
        $this->name = $this->getName();
    }

    public function getName() {
        if (preg_match("/\/[a-zA-Z0-9\-\._\\s\(\)]+$/", $this->path, $m)) {
            return str_replace("/", "", $m[0]);
        }
        return '';
    }

}
