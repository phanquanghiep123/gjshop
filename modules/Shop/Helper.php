<?php

namespace Modules\Shop;

/**
 * Description of Helper
 *
 * @author dinhtrong
 */
class Helper {
    
    public static function getContinentFromIP($ip){
        if(!config('shop.currency_baseon_region')){
            return 'EU';
        }
        if($ip === '127.0.0.1'){
            return 'EU';
        }elseif(function_exists('geoip_continent_code_by_name')){
            //sudo apt-get install php-geoip
            return geoip_continent_code_by_name($ip);
        }else {
            return 'EU';
        }
    }
    
    public static function convertContinentCodeToName($code){
        $regions = [
            'AF' => 'Africa',
            'AN' => 'Antarctica',
            'AS' => 'Asia',
            'OC' => 'Australia/Oceania',
            'EU' => 'Europe',
            'NA' => 'North America',
            'SA' => 'South America',
        ];
        return key_exists($code, $regions) ? $regions[$code] : NULL;
    }
    
    public static function createQuickbuyForm($product){
        return view('shop::_partials.product.quickbuyForm',  compact('product'))->render();
    }
    
    public static function formatPriceWithCurrency($price,$currency){
        $symbol = '';
        switch ($currency) {
            case 'USB':
                $symbol = '$';
                break;
             case 'GBP':
                $symbol = '£';
                break;
            default:
                $symbol = $currency;
                break;
        }
        return $symbol.number_format($price,2);
    }



    public static function orderStatus($status){

         switch ($status) {
                case '0':
                    $status = 'Incomplete';
                    break;

                case '1':
                    $status = 'Paid';
                    break;

                case '2':
                    $status = 'Shipped';
                    break;

                case '3':
                    $status = 'Complete';
                    break;

                case '4':
                    $status = 'Cancelled';
                    break;

                case '5':
                    $status = 'Refunded';
                    break;
                
                default:
                    $status = 'Incomplete';
                    break;
            }

        return $status;
    }

    public static function orderStatusColour($status){

         switch ($status) {
                case '0':
                    $colour = 'default';
                    break;

                case '1':
                    $colour = 'warning';
                    break;

                case '2':
                    $colour = 'dark';
                    break;

                case '3':
                    $colour = 'success';
                    break;

                 case '4':
                    $colour = 'danger';
                    break;

                case '5':
                    $colour = 'primary';
                    break;
                
                default:
                    $colour = 'default';
                    break;
            }

        return $colour;
    }
   
}
