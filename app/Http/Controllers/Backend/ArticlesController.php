<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Article;
use App\Category;
use App\Http\Requests\Backend\Articles\CreateArticleRequest;
use App\Http\Requests\Backend\Articles\UpdateArticleRequest;
use App\Http\Requests\Backend\Articles\AddProdcutRelatedArticleRequest;
use App\Http\Requests\Backend\Articles\DeleteProdcutRelatedArticleRequest;
use App\Services\FilePathService;
use App\Services\FileUploaderService;

class ArticlesController extends Controller {

    public function __construct(Article $article, Category $category) {
        parent::__construct();
        $this->article          = $article;
        $this->category         = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $articles = $this->article->with(array('author'))->get();
        $index = 1;
        return view('backend.articles.index', compact('articles', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $categories = $this->category->getAllCategoriesWithChildsByArray();
        return view('backend.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateArticleRequest $request) {
        $data         = $request->all();
        $slug         = $request->only('title');
        $clean_slug   = str_replace("&", "and", strtolower($slug['title']));
        $data['slug'] = Str::slug($clean_slug);

        $data['post_date'] = $this->getPostDateFromRequest($request);
        
        $article = $this->article->create($data);
        
        $listImage = $this->uploadListImageReturnUri($article->id, $request);
        if($listImage){
            $article->list_image = $listImage;
            $article->save();
        }
        
        $article->categories()->sync($data['categories']);
        
        if(isset($data['tags'])){
            $article->tags()->sync($data['tags']);
        }
        
        return redirect()->route('gjadmin.articles.index');
    }
    
    private function getPostDateFromRequest(Request $request){
        $result = NULL;
        $postDate = $request->input('post_date');
        if($postDate && $request->input('status') == Article::APPROVED){
            try {
                $result = \Carbon\Carbon::createFromFormat('D, d F Y', $postDate);
            } catch (\Exception $exc) {
            }
        }
        return $result;
    }
    
    private function uploadListImageReturnUri($articleID,Request $request){
        if($request->hasFile('list_image')){
            $path = FilePathService::createDirFromPublic("uploads/articles/$articleID");
            $uploader = new FileUploaderService($request->file('list_image'), $path);
            $uploader->upload();
            return $uploader->getShortUploadedFileUri();
        }
        return NULL;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $article = $this->article->findOrFail($id);

        return view('backend.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $article    = $this->article->findOrFail($id);
        $categories = $this->category->getAllCategoriesWithChildsByArray();
        return view('backend.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateArticleRequest $request, $id) {
        
        $article = $this->article->findOrFail($id);
        $data         = $request->all();

        $slug         = $request->only('title');
        $clean_slug   = str_replace("&", "and", strtolower($slug['title']));
        $data['slug'] = Str::slug($clean_slug);

        
        if ($article->approved == 2 && $article->approved_by == '') {
            $data['approved_by']   = \Auth::user()->id;
            $data['approved_date'] = \Carbon\Carbon::now();
        }
       
        $data['post_date'] = ( $request->status == 1 ? $this->getPostDateFromRequest($request) : NULL );
        $listImage = $this->uploadListImageReturnUri($article->id, $request);
        if($listImage){
            $data['list_image'] = $listImage;
        }
        
        $article->update($data);
        $article->categories()->sync($data['categories']);
        if(isset($data['tags'])){
            $article->tags()->sync($data['tags']);
        }
        
        return redirect()->back()->with('message','The article was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        $article = $this->article->findOrFail($id);
        $article->categories()->detach();
        $article->tags()->detach();
        $article->products()->detach();
        $article->delete();

        return redirect()->route('gjadmin.articles.index')->with('message','The article "' . $article->title  .'" was successfully deleted.');
    }

    public function add_product_related_article( AddProdcutRelatedArticleRequest $request) {
        
        $article = $this->article->findOrFail($request->article_id);;
        $product = \Modules\Shop\Models\Product::find($request->product_id);
        $product->articles()->save($article);

        return redirect()->back()->with('message','The article "' . $article->title . '" was successfully related to the product.');
    }

    public function delete_product_related_article( $product_id,$id) {
        
        $product = \Modules\Shop\Models\Product::find($product_id);

        $product->articles()->detach($id);

        return redirect()->back()->with('message','The article was successfully detached from the product.');
    }



    
    

}
