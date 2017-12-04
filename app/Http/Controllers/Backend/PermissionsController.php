<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Permission;
use App\Http\Requests\Backend\Permissions\CreatePermissionRequest;
use App\Http\Requests\Backend\Permissions\UpdatePermissionRequest;

class PermissionsController extends Controller
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
        $permissions = Permission::all();

        $index = 1;

        return view('backend.permissions.index', compact('permissions','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreatePermissionRequest $request)
    {   
        $data         = $request->all();
        $slug         = $data['name'];
        $data['slug'] = Str::slug($slug);
        $permission = Permission::create($data);

        return redirect()->route('gjadmin.permissions.index');
    }




    





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);

        return view('backend.permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
    
        return view('backend.permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdatePermissionRequest $request, $id)
    {       
        $permission = Permission::findOrFail($id);

        $permission->update($request->all());

        return redirect()->route('gjadmin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        
        $permission->delete();
    
        return redirect()->route('gjadmin.permissions.index')->with('message','The permission "' . $permission->name . '" was successfully deleted.');
    }

}
