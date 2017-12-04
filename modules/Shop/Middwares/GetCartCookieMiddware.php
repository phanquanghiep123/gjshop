<?php

namespace Modules\Shop\Middwares;

use Closure;
use Illuminate\Http\Request;

/**
 * Description of GetCartCookieMiddware
 *
 * @author dinhtrong
 */
class GetCartCookieMiddware {

    public function handle(Request $request, Closure $next) {
        
        if(cart()->isEmpty()){
            $cartCookie = $request->cookie('cart',[]);
            if(!empty($cartCookie)){
                $cartConverter = new \Modules\Shop\Services\CartCookieConverter($cartCookie);
                $cartConverter->convert();
            }
        }
        
        return $next($request);
    }

}
