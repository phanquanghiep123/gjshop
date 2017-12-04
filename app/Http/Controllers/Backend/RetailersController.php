<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Retailer;
use App\Http\Requests\Backend\Retailers\CreateRetailerRequest;
use App\Http\Requests\Backend\Retailers\UpdateRetailerRequest;

class RetailersController extends Controller
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
        $retailers = Retailer::all();

        $index = 1;

        return view('backend.retailers.index', compact('retailers','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.retailers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRetailerRequest $request)
    {   
        $data =  $request->all();

        $retailer = Retailer::create($data);

        return redirect()->route('gjadmin.retailers.index')->with('message','The retailer "' . $retailer->company .'" was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $retailer = Retailer::findOrFail($id);

        return view('backend.retailers.show', compact('retailer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $retailer = Retailer::findOrFail($id);
    
        return view('backend.retailers.edit', compact('retailer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateRetailerRequest $request, $id)
    {       
        $retailer = Retailer::findOrFail($id);

        $data =  $request->all();

        $retailer->update($data);

        return redirect()->back()->with('message','The retailer "'.$retailer->company .'" was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $retailer = Retailer::findOrFail($id);
        
        $retailer->delete();
    
        return redirect()->route('gjadmin.retailers.index')->with('message','The retailer "'. $retailer->company .'" was successfully deleted.');
    }

}
