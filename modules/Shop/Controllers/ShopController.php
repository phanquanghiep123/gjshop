<?php

namespace Modules\Shop\Controllers;

use App\Http\Controllers\Controller;
use Session;
use Cookie;
/**
 * Description of ShopController
 *
 * @author dinhtrong
 */
class ShopController extends Controller {
    
    public function __construct() {
        parent::__construct();
        //$this->middleware('auth');
        //$this->loggedUser = \Auth::user();
        if(!Session::has('shop.continent') && Cookie::get('continent') ){
            Session::put('shop.continent', Cookie::get('continent'));
        }
    }
}
