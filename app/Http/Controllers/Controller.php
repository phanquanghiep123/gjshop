<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\SiteSetting;

class Controller extends BaseController {
    
    use AuthorizesRequests,
    DispatchesJobs,
    ValidatesRequests;

    public function __construct() {
        \View::share('loggedUser', \Auth::user());
        \View::share('settings', SiteSetting::getSettingObject());
    }

    protected function getSlug(Request $request) {
        $uri = $request->getRequestUri();
        $uriAsArray = explode("/", $uri);
        return strtok(end($uriAsArray), '?');
    }

}
