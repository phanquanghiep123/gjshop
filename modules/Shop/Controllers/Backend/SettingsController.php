<?php

namespace Modules\Shop\Controllers\Backend;

use Modules\Shop\Controllers\ShopController;
use Illuminate\Http\Request;

/**
 * Description of SettingsController
 *
 * @author dinhtrong
 */
class SettingsController extends ShopController {
    
    public function saveSettings(Request $request){
        $setting = \App\SiteSetting::first();
        if(!$setting){
            $setting = new \App\SiteSetting();
        }
        $setting->is_multiple_shop_locations = $request->input('is_multiple_shop_locations');
        $setting->save();
        return redirect()->back();
    }
    
    public function getSettings(){
        return view('shop::settings.index');
    }
}
