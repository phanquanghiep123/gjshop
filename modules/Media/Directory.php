<?php

namespace Modules\Media;

use JsonSerializable;

/**
 * Description of Directory
 *
 * @author dinhtrong
 */
class Directory extends FileSystem implements JsonSerializable {

    public function jsonSerialize() {
        return [
            'sortPath' => $this->sortPath,
            'name' => $this->name,
            'size' => Helper::bytes(Helper::folderSize($this->path)),
            'modified' => $this->getModified()
        ];
    }

    public function getModified() {
        $timestamp = null;
        $dir = new \DirectoryIterator($this->path);
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                if ($fileinfo->getMTime() > $timestamp) {
                    $timestamp = $fileinfo->getMTime();
                }
            }
        }
        if ($timestamp) {
            $this->modified = date('Y-m-d H:i', $timestamp);
            return $this->modified;
        }
    }

}
