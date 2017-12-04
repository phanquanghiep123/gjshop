<?php

namespace Modules\Shop;

use Modules\Shop\Models\Setting;
use Cookie;
use Cache;

/**
 * Description of Currency
 *
 * @author dinhtrong
 */
class CurrencyManager {
    /*
     * Model contain value is a json converted from array
     * Array data, from Db
     * [
      'USD' => ['symbol'=> '$','default'=>true,'rate'=>1],
      'GBP' => ['symbol'=> '€','default'=>false,'rate'=>'0.88511'],
      ]
     */

    protected $setting;
    protected $currencies = [];
    protected static $instance;

    public static function getInstance(Setting $setting) {
        if (!self::$instance) {
            self::$instance = new CurrencyManager();
            self::$instance->setting = $setting;
            $currenciesValue = self::$instance->value;
            try {
                self::$instance->currencies = json_decode($currenciesValue);
            } catch (\Exception $ex) {
                self::$instance->currencies = [];
            }
        }
        return self::$instance;
    }

    private function __construct() {
        
    }

    private function __clone() {
        
    }

    public function getList() {
        $result = [];
        foreach ($this->currencies as $key => $c) {
            $result[$key] = $c->symbol;
        }
        return $result;
    }

    public function convert($price) {
        $currentCurrency = $this->getCurrentCurrency();
        $defaultCurrency = $this->getDefaultCurrency();
        
        $covertedPrice = ($price * $currentCurrency['rate'])/$defaultCurrency['rate'];
        return $currentCurrency['symbol'] .round($covertedPrice,2);
    }

    /*
     * return an array [
     *   name => USD,
     *   symbol => $,
     *   rate => 1.1111   
     * ]
     */

    public function getCurrentCurrency() {
        $return = [];
        $currency = Cookie::get('shop.currency');
        if ($currency) {
            foreach ($this->currencies as $key => $c) {
                if ($key == $currency) {
                    $return['symbol'] = $c->symbol;
                    $return['name'] = $key;
                    $return['rate'] = $c->rate;
                    break;
                }
            }
            Cookie::forever('shop.currency', $return['name']);
        } else {
            foreach ($this->currencies as $key => $c) {
                if ($c->default) {
                    $return['symbol'] = $c->symbol;
                    $return['name'] = $key;
                    $return['rate'] = $c->rate;
                    break;
                }
            }
        }
        return $return;
    }

    /*
     * return an array [
     *   name => USD,
     *   symbol => $,
     *   rate => 1.1111   
     * ]
     */

    public function getDefaultCurrency() {
        if (Cache::has('shop.defaultCurrency')) {
            return Cache::get('shop.defaultCurrency');
        }else{
            $return = [];
            foreach ($this->currencies as $key => $c) {
                if ($c->default) {
                    $return['symbol'] = $c->symbol;
                    $return['name'] = $key;
                    $return['rate'] = $c->rate;
                    break;
                }
            }
            Cache::forever('shop.defaultCurrency', $return);
            return $return;
        }
        
    }

}
