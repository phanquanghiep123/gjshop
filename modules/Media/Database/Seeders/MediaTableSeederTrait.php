<?php

namespace Modules\Media\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Modules\Media\Models\Media; 
use Symfony\Component\Finder\SplFileInfo;
use File;
use Image;

/**
 * Description of MediaTableSeeder
 *
 * @author dinhtrong
 */
trait MediaTableSeederTrait {

    public function run() {
        Model::unguard();
        $files = File::allFiles(public_path('assets/frontend/images'));
        foreach($files as $file){
            $ext = strtolower( $file->getExtension());
            if(!in_array($ext,['jpg','png','gif'])){
                continue;
            }
            
            $image = Image::make($file->getPathname());
            
            $height300 = intval((300 * $image->getHeight()) / $image->getWidth());
            $height150 = intval((150 * $image->getHeight()) / $image->getWidth());
            
            $thumbnail300Path = $this->createThumbnailFullPath($file,'300');
            $thumbnail150Path = $this->createThumbnailFullPath($file, '150');
            
            $image->resize(300,$height300);
            $image->save($thumbnail300Path);
            
            $image->resize(150,$height150);
            $image->save($thumbnail150Path,70);
            
            Media::create([
                'name' => $file->getFilename(),
                'path' => $this->convertPathToUrl($file->getPathname()),
                'mime' => File::mimeType($file->getPathname()),
                'thumbnail_150' => $this->convertPathToUrl($thumbnail150Path),
                'thumbnail_300' => $this->convertPathToUrl($thumbnail300Path)
            ]);
        }
    }
    
    private function createThumbnailFullPath(SplFileInfo $file,$suffix){
        $name = $file->getFilename();
        
        $ext = $file->getExtension();
        
        $withoutExt = $file->getBasename('.'.$ext);
        
        return $file->getPath() . '/' .$withoutExt . '_' . $suffix .'.'.$ext;
    }
    
    private function convertPathToUrl($path){
        return str_replace(public_path(),'',$path);
    }

}
