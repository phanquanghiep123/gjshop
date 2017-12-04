<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Article;


/**
 * Description of FavoriteArticlesController
 *
 * @author dinhtrong
 */
class FavoriteArticlesController extends Controller {
    
    protected $loggedUser;
    
    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
        $this->loggedUser = \Auth::user();
    }
    
    public function add(Request $request){
        $articleId = $request->input('id');
        $article = Article::find($articleId);
        if($this->loggedUser->favoriteArticles->contains($articleId)){
            return response($article->title . ' is already saved in your favorites list', 422);
        }else{
            $this->loggedUser->favoriteArticles()->attach($articleId);
            return response()->json(['message'=> $article->title . ' has been added to your favorite articles list']);
        }
        
    }

    public function delete($articleId) {
        $article = Article::findOrFail($articleId);
        $this->loggedUser->favoriteArticles()->detach($articleId);
        return response()->json(['message'=> $article->title . ' was successfully removed from your favorite articles list.']);
    }
    
    public function index(Request $request){
        $page = $request->input('page');
        \Illuminate\Pagination\Paginator::currentPageResolver(function () use ($page) {
                return $page;
        });
        $view = view('_partials.frontend.favoriteArticles',['loggedUser'=>$this->loggedUser])->render();
        return $view;
    }
}
