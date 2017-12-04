<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Illuminate\Http\Request;
use Modules\Shop\Request\Favorites\CreateFavoriteRequest;
use Modules\Shop\Request\Favorites\DeleteFavoriteRequest;
/**
 * Description of FavoriteProductsController
 *
 * @author dinhtrong
 */
class FavoriteProductsController extends ShopController {
    
    protected $loggedUser;
    
    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
        $this->loggedUser = \Auth::user();
    }
    
    public function add(CreateFavoriteRequest $request){
        $productId = $request->input('product_id');
        $product = \Modules\Shop\Models\Product::find($productId);
        if($this->loggedUser->favoriteProducts->contains($productId)){
            return response($product->name . ' is already saved in your favorites list', 422);
        }else{
            $this->loggedUser->favoriteProducts()->attach($productId);
            return response()->json(['message'=> $product->name . ' has been added to your favorites list']);
        }
        
    }

    public function delete(DeleteFavoriteRequest $request,$productId) {
        $product = \Modules\Shop\Models\Product::find($productId);
        $this->loggedUser->favoriteProducts()->detach($productId);
        return response()->json(['message'=> $product->name . ' was successfully removed from your favorites list.']);
    }
    
    public function index(Request $request){
        $page = $request->input('page');
        \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
                return $page;
        });
        $view = view('shop::_partials.favoriteProducts',['loggedUser'=>$this->loggedUser])->render();
        return $view;
    }
}
