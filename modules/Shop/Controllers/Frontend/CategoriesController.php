<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Modules\Shop\Models\ProductCategory;

/**
 * Description of CategoryControllerTrait
 *
 * @author dinhtrong
 */
class CategoriesController extends ShopController {
    
    private $category;
    
    public function __construct(ProductCategory $category) {
        parent::__construct();
        $this->category = $category;
    }
    
    public function lists(){
        $categories = $this->category->root()->actived()->get();
        return view('shop::categories.lists',  compact('categories'));
    }
    
    public function listChildCategory($slug){
        $category = $this->category->findBySlug($slug);
        
        return view('shop::categories.listChildCategory',  compact('category'));
    }
    
    public function showChildCategory($slug){

        $category = $this->category->findBySlug($slug);

        $parentCat = $category->parent()->select('id','name')->first();
/*
        $parentCat = $this->category
                          ->where('slug',$parentSlug)
                          ->select('id','name')->first();
*/
        if(!$parentCat || !$category) {
            app()->abort(404);
        }
        
        $products = $category->products()->orderBy('order','ASC')->paginate(6);
        $show_sidebar = 'Yes';
        return view('shop::categories.showChildCategory',  compact('parentCat','category','products','show_sidebar'));
    }
    
}
