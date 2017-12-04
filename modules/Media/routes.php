<?php


$middleware = config('media.middleware');
$prefix = config('media.route_prefix');

$group = [];

if($middleware){
    $group['middleware'] = $middleware;
}

if($prefix){
    $group['prefix'] = $prefix;
}
Route::group($group, function () {
    Route::get('/directory',  'Modules\Media\Controllers\FilesController@getDirectory');
    Route::post('/directory/delete',  'Modules\Media\Controllers\FilesController@delete');
    Route::post('/directory/create',  'Modules\Media\Controllers\FilesController@createFolder');
    Route::post('/file/upload',  'Modules\Media\Controllers\FilesController@upload');
    Route::get('/file/progress',  'Modules\Media\Controllers\FilesController@getUploadProgress');
});
