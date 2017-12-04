<?php

namespace Modules\Shop\Uploader\Controllers;

use Illuminate\Routing\Controller;
use File;

/**
 * Description of UploaderController
 *
 * @author dinhtrong
 */
class UploaderController extends Controller {

    public function __construct() {
        ;
    }

    protected function createUploadFolders() {
        $publicPath = public_path('uploads');
        if (!File::exists($publicPath)) {
            File::makeDirectory($publicPath, 755);
            $yearPath = $publicPath . DIRECTORY_SEPARATOR . date('Y');
            if (!File::exists($yearPath)) {
                File::makeDirectory($yearPath, 755);
                $monthPath = $yearPath . DIRECTORY_SEPARATOR . date('m');
                if (!File::exists($monthPath)) {
                    File::makeDirectory($monthPath, 755);
                    $dayPath = $monthPath . DIRECTORY_SEPARATOR . date('d');
                    if (!File::exists($dayPath)) {
                        File::makeDirectory($dayPath, 755);
                    }
                }
            }
        }
        return isset($dayPath) ? $dayPath : $publicPath . DIRECTORY_SEPARATOR . date('Y'). DIRECTORY_SEPARATOR . date('m'). DIRECTORY_SEPARATOR . date('d');
    }

}
