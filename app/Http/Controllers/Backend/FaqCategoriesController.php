<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FaqCategory;
use App\Http\Requests\Backend\FaqCategories\CreateFaqCategoryRequest;
use App\Http\Requests\Backend\FaqCategories\UpdateFaqCategoryRequest;

class FaqCategoriesController extends Controller
{
    public function __construct(FaqCategory $category)
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
        $categories = $this->category->orderBy('name','ASC')->get();

        $index = 1;

        return view('backend.faq-categories.index', compact('categories','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.faq-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateFaqCategoryRequest $request)
    {
        $category = $this->category->create($request->all());

        return redirect()->route('gjadmin.faq-categories.index')->with('message','The faq category "' . $category->name . '" was successfully added.');
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

        return view('backend.faq-categories.show', compact('category'));
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
    
        return view('backend.faq-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateFaqCategoryRequest $request, $id)
    {       
        $category = $this->category->findOrFail($id);

        $category->update($request->all());

        return redirect()->route('gjadmin.faq-categories.index');
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
    
        return redirect()->route('gjadmin.faq-categories.index')->with('message','The faq category "' . $category->name . '" was successfully deleted.');
    }

}
