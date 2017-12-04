<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PermissionCategory;
use App\Http\Requests\Backend\PermissionCategories\CreatePermissionCategoryRequest;
use App\Http\Requests\Backend\PermissionCategories\UpdatePermissionCategoryRequest;

class PermissionsCategoriesController extends Controller
{
    public function __construct(PermissionCategory $category)
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

        return view('backend.permission-categories.index', compact('categories','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.permission-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreatePermissionCategoryRequest $request)
    {
        $category = $this->category->create($request->all());

        return redirect()->route('gjadmin.permission-categories.index')->with('message','The permission category "' . $category->name . '" was successfully added.');
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

        return view('backend.permission-categories.show', compact('category'));
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
    
        return view('backend.permission-categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdatePermissionCategoryRequest $request, $id)
    {       
        $category = $this->category->findOrFail($id);

        $category->update($request->all());

        return redirect()->route('gjadmin.permission-categories.index');
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
    
        return redirect()->route('gjadmin.permission-categories.index')->with('message','The permission category "' . $category->name . '" was successfully deleted.');
    }

}
