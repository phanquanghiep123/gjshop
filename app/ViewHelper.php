<?php

namespace App;

class ViewHelper {

    public static function makeFileSelector($name, $model = null,$label=null,$cssClass = null) {
        if ($model && isset($model->$name)) {
            $file = $model->$name;
            $type = 'file';
            if (preg_match('/.(jpg|png|gif)$/i',$file)) {
                $type = 'image';
            }
            
            return view('_partials.backend.fileSelectorWithPotulator',  compact('label','type','file','name','cssClass'))->render();
        }else{
            return  view('_partials.backend.fileSelector',  compact('label','name','cssClass'))->render();
        }
    }

}
