<?php
namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class SiteSetting extends Entity {

    protected $table = "site_settings";
    protected $fillable = [
        'faceboook',
        'youtube',
        'twitter',
        'pinterest',
        'instagram',
        'google',
        'show_socials',
        'copyright',
        'uk_number',
        'us_number',
        'address',
        'copyright',
        'is_multiple_shop_locations',
        'meta_keywords',
        'meta_description'
    ];
    
    public static function getSettingObject(){
        $setting = SiteSetting::first();
        if(!$setting){
            $setting = new SiteSetting();
        }
        return $setting;
    }

}
