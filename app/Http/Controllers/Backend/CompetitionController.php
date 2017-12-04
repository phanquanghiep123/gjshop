<?php namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Competition;
use App\Page;
use App\Http\Requests\Backend\Competitions\CreateCompetitionRequest;
use App\Http\Requests\Backend\Competitions\UpdateCompetitionRequest;

class CompetitionController extends Controller
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
        $competitions = Competition::latest()->paginate(20);

        $no = $competitions->firstItem();

        return view('backend.competitions.index', compact('competitions', 'no'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cmspage = Page::where('status',1)->get();
        return view('backend.competitions.create',compact('cmspage'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( CreateCompetitionRequest $request)
    {
        $competition = Competition::create($request->all());

        return redirect()->route('gjadmin.competitions.show',$competition->id)->with('message','The competition  "'. $competition->name .'" was successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $competition = Competition::findOrFail($id);

        return view('backend.competitions.show', compact('competition'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $competition = Competition::findOrFail($id);
        $cmspage = Page::where('status',1)->get();
        return view('backend.competitions.edit', compact('competition','cmspage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update( UpdateCompetitionRequest $request, $id)
    {       
        $competition = Competition::findOrFail($id);
        $data = $request->all();
        $status_check = $data['status'];   
        $competition->update($request->all());

        return redirect()->back()->with('message','The competition "'. $competition->name .'" was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $competition = Competition::findOrFail($id);
        
        $competition->delete();
    
        return redirect()->route('gjadmin.competitions.index')->with('message','The competition "'. $competition->name .'" was successfully deleted.');
    }

}
