<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Quote;
use App\Category;
use App\Http\Requests\Backend\Quotes\CreateQuoteRequest;
use App\Http\Requests\Backend\Quotes\UpdateQuoteRequest;

class QuotesController extends Controller
{

    public function __construct(Quote $quote,Category $category)
    {   
        parent::__construct();
        $this->quote = $quote;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $quotes = Quote::with(array('category'))->get();
        $categories = $this->category->getAllCategoriesWithChildsByArray();
        $index = 1;

        return view('backend.quotes.index', compact('quotes','index','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.quotes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateQuoteRequest $request)
    {
        $quote = Quote::create($request->all());

        return redirect()->route('gjadmin.quotes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $quote = Quote::findOrFail($id);

        return view('backend.quotes.show', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $quote = Quote::findOrFail($id);
        $categories = $this->category->getAllCategoriesWithChildsByArray();
    
        return view('backend.quotes.edit', compact('quote','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateQuoteRequest $request, $id)
    {       
        $quote = Quote::findOrFail($id);

        $quote->update($request->all());

        return redirect()->route('gjadmin.quotes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $quote = Quote::findOrFail($id);
        
        $quote->delete();
    
        return redirect()->route('gjadmin.quotes.index');
    }

}
