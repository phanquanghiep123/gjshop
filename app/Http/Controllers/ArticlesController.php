<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Article;
use App\AffiliateProduct;

/**
 * Description of ArticlesController.
 *
 * @author dinhtrong
 */
class ArticlesController extends Controller {

    const ARTICLE_PER_PAGE = 9;

    protected $category;
    protected $article;
    protected $affiliateProduct;

    public function __construct(Category $category, Article $article) {
        parent::__construct();
        $this->category = $category;
        $this->article = $article;
    }

    public function listFromSubCategory(Request $request) {
        $slug = $this->getSlug($request);
        $search = $request->input('search');

        $category = $this->category->child()->where('slug', $slug)->first();
        if (!$category) {
            app()->abort(404);
        }

        $query = $category->articles()->approved()->published()->posted();

        if ($search) {
            $query->whereRaw('MATCH(title,content) AGAINST(? IN BOOLEAN MODE)', [$search]);
        }

        $articles = $query->paginate(self::ARTICLE_PER_PAGE);

        return view('articles.listFromSubCategory', compact('articles', 'category'));
    }

    public function show($categorySlug, $slug) {
        $category = $this->category->where('slug', $categorySlug)->with('parent')->first();
        if (!$category) {
            app()->abort(404);
        }
        $article = $this->article->where('slug', $slug)->first();
        if (!$article) {
            app()->abort(404);
        }
        $affiliate_link = null;

        $affiliate_link = AffiliateProduct::where('type', 'article')->where('content_id', $article->id)->first();

        return view('articles.show', compact('article', 'category', 'affiliate_link'));
    }

    public function ajaxSearch($categorySlug, Request $request) {
        $result = '';
        $search = $request->input('search');
        if ($search) {
            $category = $this->category->child()->where('slug', $categorySlug)->first();
            if ($category) {
                $articles = $category->articles()
                        ->approved()
                        ->posted()
                        ->whereRaw('MATCH(title,content) AGAINST(? IN BOOLEAN MODE)', [$search])
                        ->get();
                $result = view('_partials.frontend.articles.ajaxSearch', compact('articles', 'category', 'search'))
                        ->render();
            }
        }

        return $result;
        //$i = \LaraCart::a
    }

}
