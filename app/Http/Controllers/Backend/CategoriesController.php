<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\Backend\Categories\CreateCategoryRequest;
use App\Http\Requests\Backend\Categories\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    public function __construct(Category $category)
    {
        parent::__construct();
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->category->orderBy('position','ASC')->get();

        $index = 1;

        return view('backend.article-categories.index', compact('categories','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.article-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateCategoryRequest $request)
    {   
        $data = $request->all();
        $slug         = $data['name'];
        $clean_slug   = str_replace("&", "and", strtolower($slug));
        $data['slug'] = Str::slug($clean_slug);
        $category = $this->category->create($data);

        return redirect()->route('gjadmin.article-categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = $this->category->findOrFail($id);

        return view('backend.article-categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $category = $this->category->findOrFail($id);
    
        return view('backend.article-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCategoryRequest $request, $id)
    {       
        $category = $this->category->findOrFail($id);
        $data = $request->all();
        $slug         = $data['name'];
        $clean_slug   = str_replace("&", "and", strtolower($slug));
        $data['slug'] = Str::slug($clean_slug);
        $category->update($data);

        return redirect()->route('gjadmin.article-categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        
        $category->delete();
    
        return redirect()->route('gjadmin.article-categories.index');
    }

}
