<?php

namespace Modules\Imager;

/**
 * Description of ImagesTrait
 *
 * @author dinhtrong
 */
class ImagesTrait extends \Illuminate\Database\Eloquent\Model {
    public function images(){
        return $this->belongsToMany(\Modules\Imager\Image::class,'image_resource','image_id','resource_id')
                ->withPivot('type')->where('type',__CLASS__);
    }
}
