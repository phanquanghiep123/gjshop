<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Competition;
/**
 * Description of PageController
 *
 * @author dinhtrong
 */
class CompetitionsController extends Controller {


    private $competition;
    
    public function __construct(Competition $competition) {
        parent::__construct();
        $this->competition = $competition;
    }
    
   public function show(Request $request){
        $slug = $this->getSlug($request);
        if(!$slug){
            throw new NotFoundHttpException;
        }
        $competition = $this->competition->where('slug',$slug)->first();
        if(!$competition){
            throw new ModelNotFoundException;
        }
        if(view()->exists('pages.'.$slug)){
            return view('pages.'.$slug,  compact('competition'));
        }else{
            return view('pages.competition',  compact('competition'));
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function past_competitions()
    {
        $competitions = Competition::all();

        return view('pages.competition_winners', compact('competitions'));
    }
    
}
