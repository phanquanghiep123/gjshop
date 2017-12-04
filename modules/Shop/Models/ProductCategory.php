<?php

namespace Modules\Shop\Models;

use Modules\Shop\Models\Product;

/**
 * Description of newPHPClass
 *
 * @author dinhtrong
 */
class ProductCategory extends Model {
   
    const ACTIVE_STATUS = 1;
    const DEACTIVE_STATUS = 0;

    protected $table = "shop_product_categories";
    
    protected $fillable = [
        'name','slug','parent_id','status','list_image','meta_keywords','meta_description','list_text','show_in_menu'
    ];
    
    public function childs() {
        return $this->hasMany(__CLASS__, 'parent_id', 'id')->where('status', 1)->orderBy('created_at', 'desc');
    }
    
    public function parent() {
        return $this->belongsTo(__CLASS__, 'parent_id', 'id');
    }
    
    public function scopeRoot($query){
        return $query->where('parent_id', 0);
    }
    
    public function scopeActived($query){
        return $query->where('status',  self::ACTIVE_STATUS);
    }
    
    public function scopeChild($query){
        return $query->where('parent_id','!=', 0);
    }

    
    public function products(){
        return $this->belongsToMany("\Modules\Shop\Models\Product",'shop_product_product_category',
                    'product_category_id','product_id'
                )->where('status',Product::ACTIVE);
    }
    
    public function findBySlug($slug){
        return ProductCategory::where('slug',$slug)->first();
    }


    public function getLastestProducts($max=8){
        if($this->parent_id){
            return $this->getLastestProductsOfChildCategory($max);
        }else{
            return $this->getLastestProductsOfRootCategory($max);
        }
        
    }
    
    protected function getLastestProductsOfRootCategory($max){
        $childIds = $this->childs()->lists('id')->toArray();
        
        return Product::whereHas('categories', function($query) use ($childIds){
            $query->whereIn('shop_product_categories.id', $childIds);
        })->where('status',Product::ACTIVE)->orderBy('shop_products.created_at','desc')
          ->take($max)
          ->get();
    }
    
    protected function getLastestProductsOfChildCategory($max){
        $catId = $this->id; 
        return Product::whereHas('categories', function($query) use ($catId){
            $query->where('shop_product_categories.id', $catId);
        })->where('status',Product::ACTIVE)->orderBy('shop_products.created_at','desc')
          ->take($max)
          ->get();
    }
}
