<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Modules\Shop\Models\Setting;
use Illuminate\Http\Request;
/**
 * Description of SettingsController
 *
 * @author dinhtrong
 */
class SettingsController extends ShopController {
    
    protected $setting;
    
    public function __construct(Setting $setting) {
        parent::__construct();
        $this->setting = $setting;
    }
    
    public function setContinent(Request $request){
        $continent = $request->input('continent','EU');
        \Session::put('shop.continent', $continent);
        return redirect()->back()->withCookie(cookie()->forever('continent',$continent));
        
    }
}
