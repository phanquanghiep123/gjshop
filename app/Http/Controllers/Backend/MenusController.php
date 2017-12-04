<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Menu;
use App\Http\Requests\Backend\Menus\CreateMenuRequest;
use App\Http\Requests\Backend\Menus\UpdateMenuRequest;

class MenusController extends Controller
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
        $menus = Menu::paginate(20);

        $index = $menus->firstItem();

        return view('backend.menus.index', compact('menus', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateMenuRequest $request)
    {
        $data = Menu::create($request->all());
        return redirect()->route('backend.menus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);

        return view('backend.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
    
        return view('backend.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateMenuRequest $request, $id)
    {       
        $menu = Menu::findOrFail($id);

        $menu->update($request->all());

        return "The menu has been updated success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        $menu->delete();
    
        return redirect()->back()->with('message','The menu item "' . $menu->name . '" was successfully deleted.');
    }

}
