<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PostageRate;
use App\Http\Requests\Backend\PostageRates\CreatePostageRatesRequest;
use App\Http\Requests\Backend\PostageRates\UpdatePostageRatesRequest;

class PostageRatesController extends Controller
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
        $postageRates = PostageRate::all();
        $index = 1;
        return view('backend.postage-rates.index', compact('postageRates','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.postage-rates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreatePostageRatesRequest $request)
    {
        $data =  $request->all();
        $postageRate = PostageRate::create($data);
        return redirect()->route('gjadmin.postage-rates.index')->with('message','The postage rate "' . $postageRate->name . '" was successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $postageRate = PostageRate::findOrFail($id);
        return view('backend.postage-rates.show', compact('postageRate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $postageRate = PostageRate::findOrFail($id);
        return view('backend.postage-rates.edit', compact('postageRate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdatePostageRatesRequest $request, $id)
    {       
        $postageRate = PostageRate::findOrFail($id);
        $data =  $request->all();
        $postageRate->update($data);
        return redirect()->back()->with('message','The postage rate "' . $postageRate->name . '" was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $postageRate = PostageRate::findOrFail($id);
        $postageRate->delete();
        return redirect()->route('gjadmin.postage-rates.index')->with('message','The postage rate "' . $postageRate->name . '" was successfully deleted.');
    }

}
