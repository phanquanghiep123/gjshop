<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Illuminate\Http\Request;
use Modules\Shop\Models\Product;
use Modules\Shop\Cart;

/**
 * Description of CartsController
 *
 * @author dinhtrong
 */
class CartsController extends ShopController {

    protected $product;

    public function __construct(Product $product) {
        parent::__construct();
        $this->product = $product;
    }

    public function view(Request $request) {
        $previousUrl = $request->input('previosUrl');
        if (!$previousUrl) {
            $previousUrl = url('/');
        }
        return view('shop::cart.view', compact('previousUrl'));
    }

    public function update(Request $request) {
        $id = $request->input('id'); // item id
        $quantity = $request->input('quantity');
        $item = Cart::getCurrent()->updateQuantity($id, $quantity);
        $itemSubtotal = $item->getSubtotal();
        $total = Cart::getCurrent()->total();

        $discount = cart()->discountTotal();
        
        $this->updateQuantityToCartCookie($id, $quantity);
        
        return response()->json([
                    'itemSubtotal' => $itemSubtotal,
                    'total' => $total,
                    'quickViewHtml' => view('shop::_partials.cart.popupContent')->render(),
                    'countItems' => cart()->countItems(),
                    'discountTotal' => $discount,
                    'subTotal' => $discount + $total,
        ]);
    }

    public function add(Request $request) {
        $cart = Cart::getCurrent();
        $data = $this->getCartData($request);
        $quantity = intval($request->input('quantity'));
        $quantityAsInt = $quantity > 0 ? $quantity : 1;
        $cart->add($data, $quantityAsInt);

        $this->setCartItemCookie($request);

        if ($request->ajax()) {
            $countItems = $cart->countItems();
            $quickViewHtml = view('shop::_partials.cart.popupContent')->render();
            return response()->json(['countItems' => $countItems, 'quickViewHtml' => $quickViewHtml]);
        } else {
            $previosUrl = url()->previous();
            return response()->redirectToRoute('shop.cart.view', compact('previosUrl'));
        }
    }

    public function quickBuy(Request $request) {
        $cart = Cart::getCurrent();
        $data = $this->getQuickBuyProductData($request);
        $cart->add($data);
        $this->setCartItemCookie($request);
        if ($request->ajax()) {
            $countItems = $cart->countItems();
            $quickViewHtml = view('shop::_partials.cart.popupContent')->render();
            return response()->json(['countItems' => $countItems, 'quickViewHtml' => $quickViewHtml]);
        } else {
            $previosUrl = url()->previous();
            return response()->redirectToRoute('shop.cart.view', compact('previosUrl'));
        }
    }
    
    public function getPopupContent(){
        $data = [
            'popup' => view('shop::_partials/cart/popupContent')->render(),
            'number_of_items' => (cart()->countItems() + cart()->countCourses())
        ];
        return response()->json($data) ;
    }


    protected function setCartItemCookie(Request $request) {
        $cartCookie = $request->cookie('cart', []);
        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);

        $exits = false;

        foreach ($cartCookie as $key => $item) {
            if ($item['type'] === 'product' && $item['id'] == $productId) {
                $cartCookie[$key]['quantity'] += $quantity;
                $exits = true;
                break;
            }
        }

        if (!$exits) {
            $newItem = ['id' => $productId, 'quantity' => $quantity, 'type' => 'product'];
            $cartCookie[] = $newItem;
        }
        cookie()->queue(cookie('cart', $cartCookie,60*12));
    }

    protected function removeItemFromCartCookie($productId) {
        $cartCookie = request()->cookie('cart', []);
        foreach ($cartCookie as $key => $item) {
            if ($item['type'] === 'product' && $item['id'] == $productId) {
                unset($cartCookie[$key]);
                break;
            }
        }
        cookie()->queue(cookie()->forever('cart', $cartCookie));
    }

    protected function updateQuantityToCartCookie($productId, $quantity) {
        $cartCookie = request()->cookie('cart', []);
        foreach ($cartCookie as $key => $item) {
            if ($item['type'] === 'product' && $item['id'] == $productId) {
                if ($quantity > 0) {
                    $cartCookie[$key]['quantity'] = $quantity;
                } else {
                    unset($cartCookie[$key]);
                }
                break;
            }
        }
        cookie()->queue(cookie()->forever('cart', $cartCookie));
    }

    public function removeItem($id) {
        try {
            $cart = Cart::getCurrent();
            $cart->remove($id);
            $result = [
                'cart' => [
                    'isEmpty' => $cart->isEmpty(),
                    'total' => $cart->total(),
                    'quickViewHtml' => view('shop::_partials.cart.popupContent')->render(),
                    'orderSummaryHtml' => view('shop::_partials.cart.orderSummary')->render(),
                    'cartFormContent' => view('shop::_partials.cart.cartFormContent')->render(),
                    'countItems' => $cart->countItems(),
                    'discountTotal' => $cart->discountTotal()
                ]
            ];
            $this->removeItemFromCartCookie($id);
            return response()->json($result);
        } catch (\Modules\Shop\Exceptions\ItemNotAvailable $ex) {
            app()->abort(404);
        }
    }

    private function getQuickBuyProductData(Request $request) {
        $productId = $request->input('id');
        $product = $this->product->findOrFail($productId);
        $oldPrice = NULL;
        if ($product->isSale()) {
            $price = $product->getSalePrice();
            $oldPrice = $product->getRegularPrice();
        } else {
            $price = $product->getRegularPrice();
        }
        return [
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
    }

    private function getCartData(Request $request) {
        $productId = $request->input('id');
        $product = $this->product->find($productId);
        $price = $product->regular_price;
        $oldPrice = NULL;
        if ($product->isSale()) {
            $price = $product->getSalePrice();
            $oldPrice = $product->getRegularPrice();
        } else {
            $price = $product->getRegularPrice();
        }

        return [
            'id' => $productId,
            'name' => $product->name,
            'weight' => $product->weight,
            'taxt' => $product->taxt,
            'price' => $price,
            'oldPrice' => $oldPrice,
            'image' => $product->list_image,
            'slug' => $product->slug,
            'description' => $product->description,
            'size_uk' => $product->size_uk,
            'size_us' => $product->size_us,
            'points' => $product->points
        ];
    }

    public function setredeem(Request $request){
        $data = ["status" => 'error',"request" => $request ,"response" => null ,'messeger' => ''];
        if ($request->ajax()) {
            $use = $request->use;
            if($use == 1 || $use == 0) {
                $cart                       = Cart::getCurrent();
                $total_point_redeem         = \Auth::user()->points;
                $total_price_point_redeem   = priceValueByPoint($total_point_redeem);
                $subtotal_with_discount     = floatval($cart->subTotal()) - floatval($cart->discountTotal());

                if ($use == 1) {
                    $price_redeem = $total_price_point_redeem > $subtotal_with_discount ? $subtotal_with_discount : $total_price_point_redeem;
                    $rest_point = $total_point_redeem - pointValueByprice($price_redeem);
                    $rest_price = $total_price_point_redeem - $price_redeem;
                    $cart->setRedeemTotal($price_redeem);
                } else {
                    $price_redeem = $cart->getRedeemTotal();
                    $rest_point = $total_point_redeem;// + pointValueByprice($price_redeem);
                    $rest_price = $total_price_point_redeem;// + $price_redeem;
                    $cart->setRedeemTotal(0); 
                }

                $cart->SetRedeem ([
                    "use"   => $use,
                    "price" => $price_redeem,
                    "points" => pointValueByprice($price_redeem)
                ]);
                
                $data = [
                    "status"       =>  'success',
                    "post"         =>  $request->input() ,
                    "response"     =>  $cart->total(),
                    'points'       =>  $rest_point,
                    "price_point"  =>  $price_redeem,
                    "total_cart"   =>  $cart->total(),
                    "price_redeem" =>  $price_redeem,
                    "rest_price"   =>  $rest_price
                ];
            }
        }
        return json_encode($data);
    }

}
