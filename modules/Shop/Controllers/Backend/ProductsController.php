<?php

namespace Modules\Shop\Controllers\Backend;

use Illuminate\Support\Str;
use Modules\Shop\Models\Product;
use Modules\Shop\Request\Products\CreateProductRequest;
use Modules\Shop\Request\Products\UpdateProductRequest;
use Modules\Shop\Controllers\ShopController;
use Modules\Shop\Models\ProductCategory;

class ProductsController extends ShopController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::paginate(20);

        $index = $products->firstItem();

        return view('shop::backend.products.index', compact('products', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cat = ProductCategory::child()->select('id','name')->get();
        $categories = [];
        foreach ($cat as $c){
            $categories[$c->name] = ['name'=>'categories[]','value'=>$c->id];
        }
        return view('shop::backend.products.create',  compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = $request->all();
        $meta = [
           'sale_price' => $data['sale_price'],
           'regular_price' => $data['gbp_regular_price']
        ];
        $data['meta'] = ['GBP'=>$meta];

        if($request->slug != ''){
            $clean_slug   = str_replace("&", "and", strtolower($request->slug));
            $data['slug'] = Str::slug($clean_slug);
        } else {
            $data['slug'] = str_slug($request->name);
        }
        
        
        $product = Product::create($data);
        $product->categories()->sync($data['categories']);
        return redirect()->route('gjadmin.shop.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('shop::backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $cat = ProductCategory::child()->select('id','name')->get();
        
        $exisCategories = $product->categories()->select('shop_product_categories.id')->lists('shop_product_categories.id')->toArray();
        
        $categories = [];
        foreach ($cat as $c){
            $checked = false;
            if(in_array($c->id, $exisCategories)){
                $checked = true;
            }
            $categories[$c->name] = ['name'=>'categories[]','value'=>$c->id,'checked'=>$checked];
        }
        return view('shop::backend.products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateProductRequest $request, $id)
    {       
        $product = Product::findOrFail($id);
        
        $data = $request->all();
        $meta = [
           'sale_price' => $data['gbp_sale_price'],
           'regular_price' => $data['gbp_regular_price']
        ];
        $data['meta'] = ['GBP'=>$meta];
        
        if($data['slug'] != ''){
            $clean_slug   = str_replace("&", "and", strtolower($request->slug));
            $data['slug'] = Str::slug($clean_slug);
        } else {
            $data['slug'] = str_slug($request->name);
        }

        $data['is_featured'] = ( $request->is_featured ==  1  ? '1'  : '0' );
        $product->update($data);
        $product->categories()->sync($data['categories']);

        return redirect()->back()->with('message','The product was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        $product->delete();
    
        return redirect()->route('gjadmin.shop.products.index');
    }

}
