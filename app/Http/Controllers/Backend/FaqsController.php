<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Faq;
use App\Http\Requests\Backend\Faqs\CreateFaqRequest;
use App\Http\Requests\Backend\Faqs\UpdateFaqRequest;

class FaqsController extends Controller
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
        $faqs = Faq::all();

        $index = 1;

        return view('backend.faqs.index', compact('faqs','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateFaqRequest $request)
    {   
        
        $faq = Faq::create($request->all());

        return redirect()->route('gjadmin.faqs.index')->with('message','The faq "' . $faq->question . '" was successfully added.');;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $faq = Faq::findOrFail($id);

        return view('backend.faqs.show', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
    
        return view('backend.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateFaqRequest $request, $id)
    {       
        $faq = Faq::findOrFail($id);

        $faq->update($request->all());

        return redirect()->route('gjadmin.faqs.index')->with('message','The faq "' . $faq->question . '" was successfully updated.');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        
        $faq->delete();
    
        return redirect()->route('gjadmin.faqs.index')->with('message','The faq "' . $faq->question . '" was successfully deleted.');
    }

}
