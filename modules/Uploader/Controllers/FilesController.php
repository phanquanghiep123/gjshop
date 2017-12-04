<?php

namespace Modules\Shop\Uploader\Controllers;


use Illuminate\Http\Request;
use Modules\Uploader\RulesManager;
use Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Description of FilesController
 *
 * @author dinhtrong
 */
class FilesController extends UploaderController {
    
    private  $rulesManager;
    public function __construct() {
        parent::__construct();
        $this->rulesManager = new RulesManager();
    }
    
    public function uploadFile(Request $request){
        $file = $request->file();
        $rules = $this->rulesManager->decrypt($request->input('rules'));
        $token = $request->input('uploader_token');
        if(!$file || !$token || !Session::has('uploader.token'.$token)){
            app()->abort(422);
        }else{
            $closure = Session::get('uploader.token'.$token);
            $this->doUploadFile($file, $rules, $closure);
        }
    }
    
    private function doUploadFile(UploadedFile $file,array $rules, $closure){
        $folder = $this->createUploadFolders();
        $file->move($folder);
    }
}
