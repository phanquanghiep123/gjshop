<?php

namespace Modules\Media;

use JsonSerializable;
use Thumbnailer;
use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Routing\UrlGenerator;

/**
 * Description of File
 *
 * @author dinhtrong
 */
class File extends FileSystem implements JsonSerializable {

    protected $thumbnailer;
    protected $thumbnail;
    protected $assetPath;
    protected $url; //Illuminate\Contracts\Routing\UrlGenerator;

    public function __construct(ConfigRepository $config, UrlGenerator $url, $path) {

        parent::__construct($config, $path);

        $this->thumbnailer = Thumbnailer::getInstance();
        $patterns = [
            0 => "/" . str_replace("/", "\/", public_path('')) . "/",
            1 => "/\/\//",
            3 => "/^\//"
        ];
        $replacements = [
            0 => '',
            1 => '/',
            3 => ''
        ];

        $this->assetPath = preg_replace($patterns, $replacements, $path);

        if ($this->isAnImage($path)) {
            $this->thumbnail = $this->thumbnailer->generate($this->assetPath, 100);
        }

        $this->url = $url;
    }

    public function jsonSerialize() {
        return [
            'thumbnail' => $this->thumbnail,
            'sortPath' => $this->sortPath,
            'name' => $this->name,
            'assetPath' => $this->assetPath,
            'thumbnailUrl' => $this->thumbnail ? $this->url->asset($this->thumbnail) : NULL,
            'assetUrl' => $this->url->asset($this->assetPath),
            'size' => Helper::bytes(\File::size($this->path)),
            'modified' => $this->getModified()
        ];
    }

    protected function isAnImage($file) {
        $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp'];
        $contentType = mime_content_type($file);
        return in_array($contentType, $allowedMimeTypes);
    }

    public function getModified() {
        $timestamp = \File::lastModified($this->path);
        if (!$timestamp === false) {
            $this->modified = date('Y-m-d H:i', $timestamp);
            return $this->modified;
        }
    }

}
