<?php

namespace Modules\Shop\Services;

use Modules\Shop\Models\Product;

/**
 * Description of CartCookieConverter
 *
 * @author dinhtrong
 */
class CartCookieConverter {

    protected $cartCookie = [];
    protected $product;
    protected $cart;

    public function __construct(array $cartCookie) {
        $this->cartCookie = $cartCookie;
        $this->cart = cart();
    }

    public function convert() {
        foreach ($this->cartCookie as $item) {
            if($item['type'] !== 'product'){
                continue;
            }
            $product = Product::where('id', $item['id'])->where('inventory', '>', 0)->first();
            if ($product) {
                $oldPrice = NULL;
                if ($product->isSale()) {
                    $price = $product->getSalePrice();
                    $oldPrice = $product->getRegularPrice();
                } else {
                    $price = $product->getRegularPrice();
                }
                $data =  [
                    'id' => $product->id,
                    'name' => $product->name,
                    'weight' => $product->weight,
                    'taxt' => $product->tax,
                    'price' => $price,
                    'oldPrice' => $oldPrice,
                    'image' => $product->list_image,
                    'slug' => $product->slug,
                    'description' => $product->description,
                    'size_uk' => $product->size_uk,
                    'size_us' => $product->size_us,
                    'points' => $product->points
                ];
                $this->cart->add($data,$item['quantity']);
            }
        }
    }

}
