<?php

namespace Modules\Shop;

/**
 * Description of CurrencySessionManager
 *
 * @author dinhtrong
 */
class CurrencySessionManager {
    
    protected static  $instance;
    protected $continent;

    private function __construct() {
        $this->continent = \Session::get('shop.continent', config('shop.default_continent'));
    }

    private function __clone() {
        
    }
    
    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new CurrencySessionManager();
        }
        return self::$instance;
    }
    
    public function getCurrency() {
        if($this->continent === 'EU'){
            return "GBP";
        }
        return "USD";
    }
    
    public function getCurrencySymbol(){
        if($this->continent === 'EU'){
            return "£";
        }
        return "$";
    }
    
    public function formatPriceWithCurrency($price){
        return $this->getCurrencySymbol() . $price;
    }

}
