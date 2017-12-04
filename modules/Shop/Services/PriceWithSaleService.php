<?php

namespace Modules\Shop\Services;

use Modules\Shop\Models\Product;

/**
 * Description of PriceWithSaleService
 *
 * @author dinhtrong
 */
class PriceWithSaleService {

    private $product;
    
    public function __construct($product=NULL) {
        if($product) {
            if($product instanceof Product){
                $this->product = $product;
            }else{
                throw new Exception('product must is an instance of '.Product::class);
            }
        }
    }

    public function setProduct(Product $product) {
        $this->product = $product;
    }

    public function show($currency = 'USD') {
        if (!$this->product) {
            throw new Exception('Product is null');
        }
        if($currency === 'GBP'){
            $this->showGBPPrice();
        }else{
            $this->showUSDPrice();
        }
    }
    
    private function showUSDPrice(){
        if ($this->product->sale_price > 0 && (!$this->product->sale_expired_at || ($this->product->sale_expired_at && strtotime($this->product->sale_expired_at) > time()))) {
            echo "<b>\${$this->product->sale_price}</b> <del>\${$this->product->regular_price}</del>";
        }else{
            echo "<b>\${$this->product->regular_price}</b>";
        }
    }
    
    private function showGBPPrice(){
        $price = $this->product->meta['GBP'];
        if ($price['sale_price'] > 0 && (!$this->product->sale_expired_at || ($this->product->sale_expired_at && strtotime($this->product->sale_expired_at) > time()))) {
            echo "<b>£{$price['sale_price']}</b> <del> £{$price['regular_price']}</del>";
        }else{
            echo "<b>£{$price['regular_price']}</b>";
        }
    }
    
    
    
    public function getRegularPriceFromMeta($currency='GBP'){
        if (!$this->product) {
            throw new Exception('Product is null');
        }
        if(!isset($this->product->meta[$currency]['regular_price'])){
            return NULL;
        }else{
            return $this->product->meta[$currency]['regular_price'];
        }
    }
    
    public function getSalePriceFromMeta($currency='GBP'){
        if (!$this->product) {
            throw new Exception('Product is null');
        }
        if(!isset($this->product->meta[$currency]['sale_price'])){
            return NULL;
        }else{
            return $this->product->meta[$currency]['sale_price'];
        }
    }

}
