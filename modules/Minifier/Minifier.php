<?php

namespace Modules\Minifier;

use Illuminate\Filesystem\Filesystem;

/**
 * Description of Minifier
 *
 * @author dinhtrong
 */
class Minifier {
    
    protected $files; // Illuminate\Filesystem\Filesystem
    protected $config; // Illuminate\Config\Repository

    public function __construct(Filesystem $files,$config) {
        $this->files = $files;
        $this->config = $config;
    }
}
