<?php

namespace Modules\Shop;

use Session;

/**
 * Description of CartSession
 *
 * @author dinhtrong
 */
class CartSession {
    
    public  function getCart(){
        return Session::get('shop.cart'); 
    }
    
    public function update(Cart $cart){
        Session::put('shop.cart', $cart);
    }


    public  function forget(){
        Session::forget('shop.cart');
    }
    
    public function getContinent(){
        return Session::get('shop.continent', config('shop.default_continent'));
    }
    
}
