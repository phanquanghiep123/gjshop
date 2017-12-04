<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Page;
use App\Http\Requests\Backend\Cmspages\CreateCmspageRequest;
use App\Http\Requests\Backend\Cmspages\UpdateCmspageRequest;

class CmspagesController extends Controller
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
        $cmspages = Page::latest()->paginate(20);

        $no = $cmspages->firstItem();

        return view('backend.cmspages.index', compact('cmspages', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.cmspages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( CreateCmspageRequest $request)
    {
        
        $data = $request->except('slug');
        $prepare_slug = str_replace("&", "and", $request->title);
        $data['slug'] = str_slug($prepare_slug);
        $cmspage = Page::create($data);

        return redirect()->route('gjadmin.pages.show',$cmspage->id)->with('message','The CMS page  "'. $cmspage->title .'" was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $cmspage = Page::findOrFail($id);
        return view('backend.cmspages.show', compact('cmspage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $cmspage = Page::findOrFail($id);
    
        return view('backend.cmspages.edit', compact('cmspage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update( UpdateCmspageRequest $request, $id)
    {       
        $cmspage = Page::findOrFail($id);
        $data = $request->except('slug');

        $prepare_slug = str_replace("&", "and", $request->title);
        $data['slug'] = ( $request->slug == '' ? str_slug($prepare_slug) : str_slug($request->slug) );
       // dd($data['slug']);

        $cmspage->update($data);

        return redirect()->back()->with('message','The CMS page "'. $cmspage->title .'" was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $cmspage = Page::findOrFail($id);
        
        $cmspage->delete();
    
        return redirect()->route('gjadmin.pages.index')->with('message','The CMS page "'. $cmspage->title .'" was successfully deleted.');
    }

}
