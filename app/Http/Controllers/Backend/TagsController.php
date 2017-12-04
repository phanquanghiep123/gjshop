<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use App\Http\Requests\Backend\Tags\CreateTagRequest;
use App\Http\Requests\Backend\Tags\UpdateTagRequest;

class TagsController extends Controller
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
        $tags = Tag::all();
        $index = 1;
        return view('backend.tags.index', compact('tags','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateTagRequest $request)
    {
        $data = $request->all();
        $slug = $data['name'];
        $data['slug'] = Str::slug($slug);
        $role = Tag::create($data);
        return redirect()->route('gjadmin.tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $role = Tag::findOrFail($id);

        return view('backend.tags.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Tag::findOrFail($id);
    
        return view('backend.tags.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateTagRequest $request, $id)
    {       
        $role = Tag::findOrFail($id);

        $role->update($request->all());

        return redirect()->back()->with('message','The tag was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Tag::findOrFail($id);
        
        $role->delete();
    
        return redirect()->route('gjadmin.tags.index');
    }

}
