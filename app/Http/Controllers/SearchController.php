<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller {

    public function search(Request $request) {
        $search = $request->get('search');
        $searchIn = $request->get('search_in', 'all_areas');

        $html = '';
        
        switch ($searchIn) {
            case 'all_areas':
                $html = $this->searchProducts($search).
                        $this->searchArticle($search).
                        $this->searchPages($search).
                        $this->searchVideo($search);
                break;
            case 'articles':
                $html = $this->searchArticle($search);
                break;

            case 'videos':
                $html = $this->searchVideo($search);
                break;

            case 'products':
                $html = $this->searchProducts($search);
                break;

            case 'pages':
                $html = $this->searchPages($search);
                break;

            default:
                break;
        }
        
        return response()->json([
            'heading' => view('_partials.frontend.searches.term',  compact('search'))->render(),
            'result' => $html
        ]);
    }

    private function searchArticle($search) {
        
        $articles = \App\Article::whereRaw(

            "MATCH(title,content) AGAINST(? IN BOOLEAN MODE)", 

            array($search)

        )->whereNull('video_link')->published()->simplePaginate(10);

        return view('_partials.frontend.searches.articles', compact('articles', 'search'))->render();
    }

    private function searchPages($search) {

        $pages = \App\Page::whereRaw(

            "MATCH(title,content) AGAINST(? IN BOOLEAN MODE)", 

            array($search)

        )->active()->simplePaginate(10);

        return view('_partials.frontend.searches.pages', compact('pages', 'search'))->render();
    }

    private function searchVideo($search) {

        $videos = \App\Article::whereRaw(

            "MATCH(title,content) AGAINST(? IN BOOLEAN MODE)", 

            array($search)

        )->where('video_link','!=','')->published()->simplePaginate(10);

        return view('_partials.frontend.searches.videos', compact('videos', 'search'))->render();
    }

    private function searchProducts($search) {

        $products = \Modules\Shop\Models\Product::whereRaw(

            "MATCH(name,ean,content) AGAINST(? IN BOOLEAN MODE)", 

            array($search)

        )->where('status',1)->simplePaginate(10);

        return view('_partials.frontend.searches.products', compact('products', 'search'))->render();
    }

}
