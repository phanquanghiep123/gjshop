<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Contributor;
/**
 * Description of ContributorController
 *
 * @author dinhtrong
 */
class ContributorsController extends Controller {


    private $contributor;
    
    public function __construct(Contributor $contributor) {
        parent::__construct();
        $this->contributor = $contributor;
    }
    
   public function show(Request $request){
        $slug = $this->getSlug($request);
        if(!$slug){
            throw new NotFoundHttpException;
        }
        $contributor = $this->contributor->where('slug',$slug)->first();
        if(!$contributor){
            throw new ModelNotFoundException;
        }
        return view('contributors.show',  compact('contributor'));
    }

    
}
