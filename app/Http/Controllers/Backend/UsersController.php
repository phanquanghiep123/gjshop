<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Backend\Users\CreateUserRequest;
use App\Http\Requests\Backend\Users\UpdateUserRequest;
use App\Http\Requests\Backend\Users\UpdateUserPasswordRequest;

class UsersController extends BackendController
{


    public function __construct(User $user) {
        parent::__construct();
        $this->user          = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::latest()->get();
        $no = 1;

        return view('backend.users.index', compact('users','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        

        $data = $request->except('password');
        $data['password'] = \Hash::make($request->password);
        $user = User::create($data);

        $roles = $data['roles'];
        $user->roles()->sync($roles);
        return redirect()->to(route('gjadmin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $userRoles = [];
        foreach($user->roles as $role){
            $userRoles[] = $role->id;
        }

        return view('backend.users.show', compact('user','userRoles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        
        $userRoles = [];
        foreach($user->roles as $role){
            $userRoles[] = $role->id;
        }
        //dd($userRoles);
        return view('backend.users.edit', compact('user','userRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateUserRequest $request, $id)
    {       
        $user = User::findOrFail($id);
        $data = $request->except('password');

        if($request->password != ''){
              $data['password'] = \Hash::make($request->password);
        }
        
        $user->update($data);
        $roles = $request->get('roles');
        $user->roles()->sync($roles);
        return redirect()->back()->with('message','The user was successfully updated.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update_password(UpdateUserPasswordRequest $request)
    {       
        $user = User::findOrFail($request->id);
        // $data = $request->all();
        $data['password'] = \Hash::make($request->password);
        $user->update($data);
        return redirect()->back()->with('message',"The user's password was successfully updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {   

        $user = $this->user->findOrFail($id);
        $user->roles()->detach();
        $user->delete();
    
        return redirect()->back()->with('message',"The user " . $user->fullname() . ", was successfully deleted.");
    }

}
