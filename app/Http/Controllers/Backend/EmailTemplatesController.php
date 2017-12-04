<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EmailTemplate;
use App\Http\Requests\Backend\EmailTemplates\CreateEmailTemplateRequest;
use App\Http\Requests\Backend\EmailTemplates\UpdateEmailTemplateRequest;

class EmailTemplatesController extends Controller
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
        $emails = EmailTemplate::all();

        $index = 1;

        return view('backend.email-templates.index', compact('emails','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.email-templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateEmailTemplateRequest $request)
    {
        $data =  $request->all();
   
        $slug         = $data['name'];
        $clean_slug   = str_replace("&", "and", strtolower($slug));
        $data['name'] = Str::slug($clean_slug);
   
        $email = EmailTemplate::create($data);

        return redirect()->route('gjadmin.email-templates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $email = EmailTemplate::findOrFail($id);

        return view('backend.email-templates.show', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $email = EmailTemplate::findOrFail($id);
    
        return view('backend.email-templates.edit', compact('email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateEmailTemplateRequest $request, $id)
    {       
        $email = EmailTemplate::findOrFail($id);

        $data =  $request->all();
        
        $slug         = $data['name'];
        $clean_slug   = str_replace("&", "and", strtolower($slug));
        $data['name'] = Str::slug($clean_slug);

        $email->update($data);

        return redirect()->back()->with('message','The email was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $email = EmailTemplate::findOrFail($id);
        
        $email->delete();
    
        return redirect()->route('gjadmin.email-templates.index')->with('message','The email "' . $email->name . '" was successfully deleted.');
    }

}
