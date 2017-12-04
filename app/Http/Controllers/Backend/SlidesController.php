<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slide;
use App\Http\Requests\Backend\Slides\CreateSlideRequest;
use App\Http\Requests\Backend\Slides\UpdateSlideRequest;

class SlidesController extends Controller
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
        $slides = Slide::all();

        $index = 1;

        return view('backend.slides.index', compact('slides','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateSlideRequest $request)
    {
        $data =  $request->all();
        $slide = Slide::create($data);

        return redirect()->route('gjadmin.slides.index')->with('message','The slide was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $slide = Slide::findOrFail($id);

        return view('backend.slides.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $slide = Slide::findOrFail($id);
    
        return view('backend.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateSlideRequest $request, $id)
    {       
        $slide = Slide::findOrFail($id);
        $slide->update($request->all());

        return redirect()->back()->with('message','The slide was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);
        $slide->delete();
    
        return redirect()->route('gjadmin.slides.index')->with('message','The slide was successfully deleted.');
    }

}
