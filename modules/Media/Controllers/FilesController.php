<?php

namespace Modules\Media\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Media\FileManager;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Config\Repository as ConfigRepository;
use File;
use Modules\Media\Requests\CreateNewFolderRequest;
use Modules\Media\Directory;
use Thumbnailer;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Modules\Media\Requests\UploadFileRequest;

/**
 * Description of FilesController
 *
 * @author dinhtrong
 */
class FilesController extends Controller {

    protected $basePath;
    protected $fileManager;
    protected $url;
    protected $config;
    protected $thumbnailer;

    public function __construct(ConfigRepository $config, UrlGenerator $url) {
        parent::__construct();
        $this->config = $config;
        $this->url = $url;
        $this->basePath = config('media.base_path');
        $this->fileManager = new FileManager($this->config, $this->url);
        $this->thumbnailer = Thumbnailer::getInstance();
    }

    public function getDirectory(Request $request) {

        $dir = $request->input('dir');
        if (!$dir) {
            $dirPathFromCookie = $request->cookie('default_media_path');
            $dirPath = $dirPathFromCookie ? : $this->basePath;
            if (!File::exists($dirPath)) {
                $dirPath = $this->basePath;
            }
        } else {
            $dirPath = $this->basePath . $dir;
        }

        $this->fileManager->setPath($dirPath);

        $defaultPathCookie = cookie()->make('default_media_path', $dirPath);
        cookie()->queue($defaultPathCookie);

        $data = [
            'files' => $this->fileManager->listFiles(),
            'directories' => $this->fileManager->listDirectories(),
            'current' => str_replace($this->basePath, '', $dirPath)
        ];

        $tyle = $request->input('type', 'json');
        if ($tyle === 'draw') {
            
        } else {
            return response()->json(compact('data'));
        }
    }

    public function delete(Request $request) {
        $files = $request->input('files', []);
        $directories = $request->input('directories', []);
        foreach ($files as $file) {
            File::delete($this->basePath . $file);
            $this->thumbnailer->remove($this->basePath . $file);
        }
        foreach ($directories as $dir) {
            File::deleteDirectory($this->basePath . $dir);
        }
    }

    public function createFolder(CreateNewFolderRequest $request) {
        $path = $this->basePath . $request->input('current') . '/' . $request->input('name');
        try {
            File::makeDirectory($path);
            $dir = new Directory($this->config, $path);
            return response()->json($dir);
        } catch (\Exception $ex) {
            return response("The directory name is invalid or exist", 422);
        }
    }

    public function upload(UploadFileRequest $request) {
        $file = $request->file('file');
        if (!$file) {
            dd($request->file());
        }
        $current = $request->input('current');
        $fileName = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $savedName = self::getSavedFileName($this->basePath . $current, $fileName, $ext);
        $file->move($this->basePath . $current, $savedName);
        $path = $this->basePath . $current . '/' . $savedName;
        $mediaFile = new \Modules\Media\File($this->config, $this->url, $path);
        return response()->json($mediaFile);
    }

    private static function getSavedFileName($directory, $fileName, $ext) {
        $onlyName = pathinfo($fileName, PATHINFO_FILENAME);
        if (\File::exists($directory . '/' . $fileName)) {
            if (preg_match('/[0-9]+$/', $onlyName, $m)) {
                $next = intval($m[0]) + 1;
                $ultimateName = preg_replace('/[0-9]+$/', $next, $onlyName);
            } else {
                $ultimateName = $onlyName . '_1';
            }
            $ultimateName = \Modules\Media\Helper::cleanString($ultimateName);
            $ultimateNameWithExt = $ext ? $ultimateName . "." . $ext : $ultimateName;
            return self::getSavedFileName($directory, $ultimateNameWithExt, $ext);
        } else {
            $validName =  \Modules\Media\Helper::cleanString($onlyName);
            return $ext ? $validName.'.'.$ext : $validName;
        }
    }

    public function getUploadProgress() {
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        if (isset($_REQUEST['progresskey'])) {
            $status = apc_fetch('upload_' . $_REQUEST['progresskey']);
        } else {
            exit(json_encode(array('success' => false)));
        }

        $pct = 0;
        $size = 0;

        if (is_array($status)) {

            if (array_key_exists('total', $status) && array_key_exists('current', $status)) {

                if ($status['total'] > 0) {
                    $pct = round(($status['current'] / $status['total']) * 100);
                    $size = round($status['total'] / 1024);
                }
            }
        }

        return response()->json(array('success' => true, 'pct' => $pct, 'size' => $size));
    }

}
