<?php

namespace Modules\Shop\Controllers\Backend;

use Illuminate\Support\Str;
use Modules\Shop\Controllers\ShopController;
use Modules\Shop\Request\ProductCategories\CreateProductCategoryRequest;
use Modules\Shop\Request\ProductCategories\UpdateProductCategoryRequest;
use Modules\Shop\Models\ProductCategory;
/**
 * Description of ProductCategoriesController
 *
 * @author dinhtrong
 */
class ProductCategoriesController extends ShopController {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $productcategories = ProductCategory::paginate(20);

        $index = $productcategories->firstItem();

        return view('shop::backend.productcategories.index', compact('productcategories', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('shop::backend.productcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateProductCategoryRequest $request)
    {   
        $data =  $request->all();
        if($request->slug == ''){
            $slug         = $data['name'];
            $clean_slug   = str_replace("&", "and", strtolower($slug));
            $data['slug'] = Str::slug($clean_slug);
        }
        $productcategory = ProductCategory::create($data);

        return redirect()->route('gjadmin.shop.productcategories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $productcategory = ProductCategory::findOrFail($id);

        return view('shop::backend.productcategories.show', compact('productcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $productcategory = ProductCategory::findOrFail($id);
    
        return view('shop::backend.productcategories.edit', compact('productcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateProductCategoryRequest $request, $id)
    {     
        $productcategory = ProductCategory::findOrFail($id);
        $data =  $request->all();
        if($request->slug == ''){
            $slug         = $data['name'];
            $clean_slug   = str_replace("&", "and", strtolower($slug));
            $data['slug'] = Str::slug($clean_slug);
        }
        $productcategory->update($data);

        return redirect()->to(route('gjadmin.shop.productcategories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $productcategory = ProductCategory::findOrFail($id);
        
        $productcategory->delete();
    
        return redirect()->route('gjadmin.shop.productcategories.index');
    }

}
