<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Modules\Shop\Models\ProductCategory;
use Modules\Shop\Models\Product;
use Modules\Shop\Models\Favorite;
use Modules\Shop\Models\ProductReview;
use Modules\Shop\Request\Reviews\CreateReviewRequest;
use Modules\Shop\Request\Reviews\UpdateReviewRequest;
use Modules\Shop\Request\Favorites\CreateFavoriteRequest;

use Illuminate\Http\Request;
/**
 * Description of ProductsController
 *
 * @author dinhtrong
 */
class ProductsController extends ShopController{
    
    protected $category;
    protected $product;

    public function __construct(ProductCategory $category,Product $product) {
        parent::__construct();
        $this->category = $category;
        $this->product  = $product;
    }
    
    public function show($slug){
        $product = $this->product->findBySlug($slug);
        if(!$product || $product->status == Product::INACTIVE){
            app()->abort(404);   
        }
        $reviews = ProductReview::where('product_id',$product->id)
                ->approved()->orderBy('created_at', 'desc')->get();
        $show_sidebar = 'Yes';
        return view('shop::products.show',  compact('product','reviews','show_sidebar'));
    }
    
    public function search(Request $request){
        $keyword = trim($request->input('search'));
        $products = $this->product->where('name','like',"%$keyword%")->orWhere('ean',$keyword)->where('status',Product::ACTIVE)->paginate(6);
        $show_sidebar = 'Yes';
        return view('shop::products.search',  compact('products','keyword','show_sidebar'));
    }


    public function addReview(CreateReviewRequest $request) {
        $data = $request->all();
        $data['comment'] = '<p>'. $data['comment']  .'</p>';
        $review = ProductReview::create($data);

        if($review){
            return response()->json(['message'=> 'Your review was submitted and added to the approval queue, Thanks!']);
        }else{
            return response("Something went wrong, please try again",422);
        }


        // return redirect()->back();
    }
    
    public function addFavorite($id){
        $user = \Auth::user();
        if($user){
            $user->favoriteProducts()->attach($id);
        }else{
            app()->abort(401);
        }
    }

    public function deleteFavorite(Request $request) {
        $data = $request->all();
        //dd($data);
        $favorite = Favorite::find($data['favorite_id']);
        $favorite->delete();
        return redirect()->back();
    }
    
    public function getFavoritesProducts(Request $request){
        $loggedUser = \Auth::user();
        if($loggedUser){
            $page = $request->input('page');
            \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
                return $page;
            });
            $view = view('shop::_partials.favoriteProducts',  compact('loggedUser'))->render();
            return $view;
        }else{
            app()->abort(401);
        }
    }

}
