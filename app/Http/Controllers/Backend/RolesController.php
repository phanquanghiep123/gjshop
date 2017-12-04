<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Http\Requests\Backend\Roles\CreateRoleRequest;
use App\Http\Requests\Backend\Roles\UpdateRoleRequest;

class RolesController extends Controller
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
        $roles = Role::all();

        $index = 1;

        return view('backend.roles.index', compact('roles','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $data = $request->except('slug');
        $data['slug'] = str_slug($request->name);
        $role = Role::create($data);
        return redirect()->route('gjadmin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('backend.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateRoleRequest $request, $id)
    {       
        $role = Role::findOrFail($id);
        $data = $request->except('slug');
        $data['slug'] = str_slug($request->name);
        $role->update($data);
        return redirect()->back()->with('message','The role was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();    
        return redirect()->route('gjadmin.roles.index')->with('message','The role "' . $role->name . '" was successfully deleted.');
    }

}
