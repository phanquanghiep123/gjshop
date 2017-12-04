<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

/**
 * Description of CategoriesController
 *
 * @author dinhtrong
 */
class CategoriesController extends Controller{
    
 

    protected $category;
    
    public function __construct(Category $category) {
        parent::__construct();
        $this->category = $category;
    }
    
   
    public function listFromRootCategory(Request $request){
        $slug = $this->getSlug($request);
        $category = $this->category->root()->where('slug',$slug)->first();
        if(!$category){
            app()->abort(404);
        }
        return view('categories.listFromRootCategory',  compact('category'));
    }
    
    

}
