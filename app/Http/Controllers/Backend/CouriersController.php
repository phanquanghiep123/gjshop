<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Courier;
use App\Http\Requests\Backend\Couriers\CreateCourierRequest;
use App\Http\Requests\Backend\Couriers\UpdateCourierRequest;

class CouriersController extends Controller
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
        $couriers = Courier::all();
        $index = 1;
        return view('backend.couriers.index', compact('couriers','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.couriers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateCourierRequest $request)
    {
        $data =  $request->all();
        $courier = Courier::create($data);
        return redirect()->route('gjadmin.couriers.index')->with('message','The courier "' . $courier->name . '" was successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $courier = Courier::findOrFail($id);
        return view('backend.couriers.show', compact('courier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $courier = Courier::findOrFail($id);
        return view('backend.couriers.edit', compact('courier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateCourierRequest $request, $id)
    {       
        $courier = Courier::findOrFail($id);
        $data =  $request->all();
        $courier->update($data);
        return redirect()->back()->with('message','The courier was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $courier = Courier::findOrFail($id);
        $courier->delete();
        return redirect()->route('gjadmin.couriers.index')->with('message','The courier "' . $courier->name . '" was successfully deleted.');
    }

}
