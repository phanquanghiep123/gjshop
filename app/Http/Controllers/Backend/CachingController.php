<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Engine\Menu as MenuEngine;
/**
 * Description of CachingController
 *
 * @author dinhtrong
 */
class CachingController extends Controller {


	public function __construct() {
       parent::__construct();
    }

    public function index(){
        return view('backend.caches.index');
    }
    
    public function refreshMenuCaching(Request $request){
        $name = $request->input('name');
        MenuEngine::cacheMenu($name);
        return redirect()->back();
    }
}
