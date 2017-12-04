<?php

namespace Modules\Shop;

use Modules\Shop\Models\Setting;
use Cache;
use Modules\Shop\Exceptions\CurrencySettingModelNotFound;

/**
 * Description of CurrencySetting
 *
 * @author dinhtrong
 */
class CurrencySetting {

    private $setting = NULL;
    private $model;
    
    private static $instance;
    public static function getInstance(){
        if(self::$instance){
            return self::$instance;
        }else{
            self::$instance = new CurrencySetting();
            return self::$instance;
        }
    }

    private function __construct() {
        $this->model = new Setting();
    }

    private function __clone() {
        
    }

    public function setModal(Setting $model) {
        $this->model = $model;
    }

    public function getSetting() {
        if ($this->setting) {
            return $this->setting;
        } else {
            $settingFromCache = Cache::get('shop.currencySetting');
            if ($settingFromCache) {
                return $settingFromCache;
            } else {
               return $this->getSettingFromDBAndCache(); 
            }
        }
    }

    private function getSettingFromDBAndCache() {
        $settingFromDB = $this->model->where('key', 'currencies')->first();
        if ($settingFromDB) {
            Cache::forever('shop.currencySetting', $settingFromDB);
            return $settingFromDB;
        } else {
            throw new CurrencySettingModelNotFound;
        }
    }

}
