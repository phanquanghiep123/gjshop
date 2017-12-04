<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Str;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;
use App\Http\Requests\Backend\News\CreateNewsRequest;
use App\Http\Requests\Backend\News\UpdateNewsRequest;

class NewsController extends Controller
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
        $news = News::all();

        $index = 1;

        return view('backend.news.index', compact('news','index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateNewsRequest $request)
    {   
        $data =  $request->all();
        if($request->slug == ''){
            $slug         = $data['title'];
            $clean_slug   = str_replace("&", "and", strtolower($slug));
            $data['slug'] = Str::slug($clean_slug);
        }
        $data['post_date'] = date('Y-m-d',strtotime( $request->post_date ));
        $news = News::create($data);

        return redirect()->route('gjadmin.news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('backend.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('backend.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateNewsRequest $request, $id)
    {       
        $news = News::findOrFail($id);
        $data =  $request->all();
        if($request->slug == ''){
            $slug         = $data['title'];
            $clean_slug   = str_replace("&", "and", strtolower($slug));
            $data['slug'] = Str::slug($clean_slug);
        }
        $data['post_date'] = date('Y-m-d',strtotime( $request->post_date ));
        $news->update($data);
        return redirect()->back()->with('message','The news item "'.$news->title .'" was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();
        return redirect()->route('gjadmin.news.index')->with('message','The news item was successfully delete.');
    }

}
