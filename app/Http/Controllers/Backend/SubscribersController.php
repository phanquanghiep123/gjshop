<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Newsletter;
use App\Http\Requests\Backend\Newsletters\CreateNewsletterRequest;
use App\Http\Requests\Backend\Newsletters\UpdateNewsletterRequest;

class SubscribersController extends Controller
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
        $subscribers = Newsletter::all();

        $no = 1;

        return view('backend.subscribers.index', compact('subscribers','no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.subscribers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateNewslettersRequest $request)
    {
        $data =  $request->all();
        $subscriber = Newsletter::create($data);

        return redirect()->route('gjadmin.subscribers.index')->with('message','The subscriber "' . $subscriber->signup_name . '" was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $subscriber = Newsletter::findOrFail($id);

        return view('backend.subscribers.show', compact('subscriber'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $subscriber = Newsletter::findOrFail($id);
    
        return view('backend.subscribers.edit', compact('subscriber'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateNewslettersRequest $request, $id)
    {       
        $subscriber = Newsletter::findOrFail($id);

        $data =  $request->all();
        $subscriber->update($data);

        return redirect()->back()->with('message','The subscriber was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $subscriber = Newsletter::findOrFail($id);
        
        $subscriber->delete();
    
        return redirect()->route('gjadmin.subscribers.index')->with('message','The subscriber "' . $subscriber->signup_name . '" was successfully deleted.');
    }

}
