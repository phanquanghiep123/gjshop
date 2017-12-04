<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Http\Requests\Backend\Brands\CreateBrandsRequest;
use App\Http\Requests\Backend\Brands\UpdateBrandsRequest;

class BrandsController extends Controller
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
        $brands = Brand::all();

        $index = 1;

        return view('backend.brands.index', compact('brands','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateBrandsRequest $request)
    {
        $data =  $request->all();
        if($request->slug == ''){
            $slug         = $data['name'];
            $clean_slug   = str_replace("&", "and", strtolower($slug));
            $data['slug'] = Str::slug($clean_slug);
        }
        $brand = Brand::create($data);

        return redirect()->route('gjadmin.brands.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $brand = Brand::findOrFail($id);

        return view('backend.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
    
        return view('backend.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateBrandsRequest $request, $id)
    {       
        $brand = Brand::findOrFail($id);

        $data =  $request->all();
        if($request->slug == ''){
            $slug         = $data['name'];
            $clean_slug   = str_replace("&", "and", strtolower($slug));
            $data['slug'] = Str::slug($clean_slug);
        }

        $brand->update($data);

        return redirect()->back()->with('message','The brand was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        
        $brand->delete();
    
        return redirect()->route('gjadmin.brands.index')->with('message','The brand "' . $brand->name . '" was successfully deleted.');
    }

}
