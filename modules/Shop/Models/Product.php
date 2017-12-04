<?php

namespace Modules\Shop\Models;

use Modules\Shop\CurrencyManager;
use Modules\Shop\CurrencySetting;
use Modules\Shop\Models\ProductReview;
use Modules\Shop\Models\Setting;

/**
 * Description of ProductTrait
 *
 * @author dinhtrong
 */
class Product extends Model {

    const ACTIVE = 1;
    const INACTIVE = 0;
    const PUBLISHED = 1;
    


    const PRODUCT_TYPE_PHYSICAL = 1;
    const PRODUCT_TYPE_DIGITAL = 2;


    protected $continent = '';
    protected $table = "shop_products";
    protected $fillable = [
        'name', 'slug', 'images', 'list_image', 'content', 'description','status','inventory',
        'is_featured', 'regular_price', 'sale_price', 'sale_expired_at', 'weight','duration',
        'tax', 'ship_fee', 'meta','list_description','product_video','ean','ingredience','displayed_weight',
        'extra_content','dimentions','size_us','size_uk','meta_keywords','meta_description','points'
    ];
    protected $dates = ['sale_expired_at', 'created_at', 'updated_at'];
    protected $casts = [
        'images' => 'array',
        'meta' => 'array',
        'is_featured' => 'boolean'
    ];

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->continent = \Session::get('shop.continent',  config('shop.default_continent'));
    }

    public function scopePublished($query) {
        return $query->where('status', self::PUBLISHED);
    }
    public function scopeLowInventory($query) {
        $amount = Setting::where('key','low_inventory_amount')->value('value');
        return $query->where('status',self::ACTIVE)->where('inventory','<=',$amount);
    }

    public function setContinent($continent){
        $this->continent = $continent;
    }

    public function categories() {
        return $this->belongsToMany("\Modules\Shop\Models\ProductCategory", 'shop_product_product_category', 'product_id', 'product_category_id');
    }

    public function tags(){
        return $this->belongsToMany("App\Tag",'content_tag','resource_id')->withPivot('resource_type')->where('resource_type','foodguide');
    }

    public function reviews() {
        return $this->hasMany('\Modules\Shop\Models\ProductReview','product_id','id');
    }

    public function certificates() {
        return $this->belongsToMany('\Modules\Shop\Models\Certificate','shop_product_certificates','product_id','certificate_id');
    }
    
    public function articles()
    {
        return $this->belongsToMany('\App\Article','article_product','product_id','article_id');
    }
    
    public function favoritedUsers(){
        return $this->belongsToMany("\App\User", 'shop_favorites_products', 'shop_product_id', 'user_id');
    }

    public function subscription()
    {
        return $this->belongsTo('\Modules\Shop\Models\StockNotificationEmail', 'product_id');
    }

    public function setSaleExpiredAtAttribute($value) {
        $this->attributes['sale_expired_at'] = $value;
    }
    
    public function getSaleExpiredAtAttribute($value) {
        if(!$value || $value == '0000-00-00 00:00:00'){
            return NULL;
        }
        return $value;
    }

    public function findBySlug($slug) {
        return Product::where('slug', $slug)->first();
    }

    public static function featured() {
        return Product::where('is_featured',1)->get();
    }

/*
    public static function related($category,$productId) {

        // $related = $category->products()->where('shop_products.id','!=',$productId)->get();

        $related = \DB::
        return $related;
    }
*/
    public function relatedProducts() {
        return $this->belongsToMany('\Modules\Shop\Models\Product', 'related_products', 'related_product_id', 'product_id');
    }

    public function getRegularPriceFormated() {
        if ($this->continent == 'EU') {
            return '£' . $this->meta['GBP']['regular_price'];
        } else {
            return '$' . $this->regular_price;
        }
    }

    public function getSalePriceFormated() {
        if ($this->continent == 'EU') {
            return '£' . $this->meta['GBP']['sale_price'];
        } else {
            return '$' . $this->sale_price;
        }
    }

    public function getRegularPrice() {
        if ($this->continent == 'EU') {
            return $this->meta['GBP']['regular_price'];
        } else {
            return $this->regular_price;
        }
    }

    public function getSalePrice() {
        if ($this->continent == 'EU') {
            return $this->meta['GBP']['sale_price'];
        } else {
            return $this->sale_price;
        }
    }

    public function getSavings() {
        $symbol = ( $this->continent == 'EU' ? '£' : '$' );
        return $symbol .  ( round($this->getRegularPrice() -  $this->getSalePrice(),0, PHP_ROUND_HALF_DOWN) );
    }


    public function getPoints() {
        return $this->purchase_loyalty_points;
    }

    
    public function isSale(){
        if ($this->continent == 'EU') {
            $price = $this->meta['GBP'];
            return ($price['sale_price'] > 0 
                    && (!$this->sale_expired_at 
                        || ($this->sale_expired_at 
                            && strtotime($this->sale_expired_at) > time())));
        } else {
            return ($this->sale_price > 0 
                    && (!$this->sale_expired_at 
                        || ($this->sale_expired_at
                            && strtotime($this->sale_expired_at) > time())));
        }
    }

}
