<?php
namespace Modules\Shop;

use Modules\Shop\Exceptions\CartItemDataMissing;
use Modules\Shop\Exceptions\ItemNotAvailable;
use Modules\Shop\Models\ShippingMethod;
use Modules\Shop\NonProductItem\CourseCartTrait;
use Modules\Shop\Models\DiscountCode;

/**
 * Description of Cart
 *
 * @author dinhtrong
 */
class Cart
{

    protected $items       = [];
    protected $cartSession;
    protected $shippingMethod; //ShippingMethod Model
    protected $continent; // NA|EU
    protected static $cart = NULL;
    protected $shipToCountry; // UK | US |RW ( Rest of World) 
    protected $discount;  // Discount object model
    protected $size        = ['LL', 'SP', 'MP'];
    public    $redeem  = ["use" => 0 ,"price" => 0 ,"points" => 0];
    public    $stripe;
    protected $redeemTotal = 0;
    use CourseCartTrait;

    private function __construct()
    {
        $this->cartSession    = new CartSession();
        $this->continent      = config('shop.currency_baseon_region', false) ?
        $this->cartSession->getContinent() : 'EU';
        $this->shippingMethod = new ShippingMethod();
    }

    private function __clone()
    {
        
    }

    public function getItems()
    {
        return $this->items;
    }
    public function Setstripe ($stripe){
        $this->stripe = $stripe;
        $this->cartSession->update($this);
    }
    public function Getstripe(){
        return $this->stripe;
    }
    public function SetRedeem($redeem)
    {   
        $this->redeem = $redeem;
        $this->cartSession->update($this);
    }
    public function GetRedeem()
    {
        return $this->redeem;  
    }
    public function GetPriceRedeem(){
        //$total = $this->subTotal();
        //$total -= $this->discountTotal();
        $price_redeem = 0;
        if($this->redeem["use"] == 1){
           $price_redeem = $this->redeem["price"];
        }
        return $price_redeem;
    }
    public static function getCurrent()
    {
        $that = new Cart();
        $cart = $that->cartSession->getCart();
        return $cart ? $cart : $that;
    }

    public function getShipToContinent()
    {
        return $this->shipToCountry;
    }

    public function setShipToCountry($shipToCountry)
    {
        $this->shipToCountry = $shipToCountry;
    }

    public function getShipToCountry()
    {
        return $this->shipToCountry;
    }

    public function getContinent()
    {
        return $this->continent;
    }

    public function isEmpty()
    {
        return empty($this->items) && $this->isEmptyCourse();
    }

    public function isEmptyItems()
    {
        return empty($this->items);
    }
    /*
     * @input :
     *  [
     *      data : ['id' : product id, require
     *      'name' : product name 
     *      'options' : like size, color... , require
     *      'price', require
     *      'taxt',
     *      'ship' : ship fee,
     *      'image','points',
     *      'weight'
     * ],
     *      quantily : number of item, 
     *      
     *  ]
     */

    public function add($data, $quantily = 1)
    {

        $this->validateItemData($data);

        if (key_exists($data['id'], $this->items)) {
            $currentQuantily = $this->items[$data['id']]->getQuantily();
            $this->items[$data['id']]->setQuantity($currentQuantily + $quantily);
        } else {
            $cItem                    = new Item();
            $cItem->setName($data['name']);
            $cItem->setPrice($data['price']);
            $cItem->setPoints($data['points']);
            $cItem->setUKSize($data['size_uk']);
            $cItem->setUSSize($data['size_us']);
            $cItem->setQuantity($quantily);
            $this->addOptionsCartData($cItem, $data);
            $this->items[$data['id']] = $cItem;
        }

        $this->cartSession->update($this);
    }
    /*
     * @Input : item id : int, addition item quantity 
     * @return : item
     */

    public function updateQuantity($id, $quantity)
    {
        if (!isset($this->items[$id])) {
            throw new ItemNotAvailable();
        }
        $this->items[$id]->setQuantity($quantity);

        $this->cartSession->update($this);

        return $this->items[$id];
    }
    /*
     * @input : product id
     */

    public function remove($id)
    {
        if (key_exists($id, $this->items)) {
            unset($this->items[$id]);
        } else {
            throw new ItemNotAvailable();
        }
        $this->cartSession->update($this);
    }

    protected function addOptionsCartData(Item $cItem, $data)
    {
        if (key_exists('oldPrice', $data) && $data['oldPrice'] !== NULL) {
            $cItem->setOldPrice($data['oldPrice']);
        }
        if (key_exists('options', $data)) {
            $cItem->setOptions($data['options']);
        }
        if (key_exists('taxt', $data)) {
            $cItem->setTax($data['taxt']);
        }
        if (key_exists('ship', $data)) {
            $cItem->setShip($data['ship']);
        }
        if (key_exists('weight', $data)) {
            $cItem->setWeight($data['weight']);
        }
        if (key_exists('image', $data)) {
            $cItem->setImage($data['image']);
        }
        if (key_exists('slug', $data)) {
            $cItem->setSlug($data['slug']);
        }
        if (key_exists('description', $data)) {
            $cItem->setDescription($data['description']);
        }
        if (key_exists('points', $data)) {
            $cItem->setPoints($data['points']);
        }
    }

    protected function validateItemData($data)
    {
        if (!key_exists('id', $data) ||
                !key_exists('name', $data) ||
                !key_exists('size_uk', $data) ||
                !key_exists('size_us', $data) ||
                !key_exists('points', $data) ||
                !key_exists('price', $data)) {
            throw new CartItemDataMissing();
        }
    }

    public function destroy()
    {
        return $this->cartSession->forget();
    }

    public function subTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }
        return $total + $this->getTotalOfCourses();
    }

    // subTotal after discount
    public function total()
    {
        $total = $this->subTotal();
        $total -= $this->discountTotal();
        $total -= $this->getRedeemTotal();
        return $total > 0 ? round($total, 2) : 0;
    }

    public function discountTotal()
    {
        $discount = $this->discount;
        if ($discount) {
            if ($discount->discount_type == Models\DiscountCode::TYPE_PERCENT) {
                return round(($this->subTotal() * $discount->discount_amount) / 100, 2);
            } else {
                return $discount->discount_amount;
            }
        }
        return 0;
    }

    public function getRedeemTotal()
    {
        $subTotalWithDiscount = floatval($this->subTotal()) - floatval($this->discountTotal());
        $price_redeem = 0;
        if ($this->redeem["use"] == 1) {
            $price_redeem = (($subTotalWithDiscount - pointsValue(\Auth::user())) > 0 )  ? pointsValue(\Auth::user()) :  $subTotalWithDiscount;
        }
        $this->redeemTotal = $price_redeem; 
        return $this->redeemTotal;
    }

    public function setRedeemTotal($total)
    {
        $this->redeemTotal = $total;
    }

    public function getShippingFee()
    {
        if (!$this->shippingMethod) {
            return 0;
        }
        return $this->shippingMethod->fee;
    }

    public function getTax()
    {
        return 0;
    }

    public function getShippingMethod()
    {
        return $this->shippingMethod;
    }

    public function setShippingMethod(ShippingMethod $shippingMethod)
    {
        $this->shippingMethod = $shippingMethod;
        $this->cartSession->update($this);
    }

    public function getDiscount()
    {
        return $this->discount;
    }

    public function setDiscount($discount)
    {
        $this->discount = $discount;
        $this->cartSession->update($this);
    }

    public function removeDiscount()
    {
        $this->discount = null;
        // $this->updateRedeem();
        $this->cartSession->update($this);
    }

    public function updateRedeem() {
        $cart                       = Cart::getCurrent();
        $total_point_redeem         = \Auth::user()->points;
        $total_price_point_redeem   = priceValueByPoint($total_point_redeem);
        $subtotal_with_discount     = floatval($cart->subTotal()) - floatval($cart->discountTotal());

        if ($this->redeem["use"] == 1) {
            $price_redeem = $total_price_point_redeem > $subtotal_with_discount ? $subtotal_with_discount : $total_price_point_redeem;
            $rest_point = $total_point_redeem - pointValueByprice($price_redeem);
            $rest_price = $total_price_point_redeem - $price_redeem;
            $cart->setRedeemTotal($price_redeem);
            $cart->SetRedeem ([
                "use"   => $this->redeem["use"],
                "price" => $price_redeem,
                "points" => pointValueByprice($price_redeem)
            ]);
        }
    }

    /*
      unix : g
     */

    public function getWeight()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getWeight() * $item->getQuantity();
        }
        return $total;
    }

    public function countItems()
    {
        $return = 0;
        foreach ($this->items as $item) {
            $return += $item->getQuantily();
        }
        return $return + $this->countCourses();
    }
    /*
     * Each product has size_uk and size_us.
     * The uk size by order (esc) : LL,SP,MP 
     */

    public function getLargestSize()
    {
        if ($this->continent === 'EU') {
            $method = 'getUKSize';
        } else {
            $method = 'getUSSize';
        }
        for ($i = 1; $i <= 3; $i++) {
            foreach ($this->items as $item) {
                switch ($i) {

                    case 1:
                        if ($item->$method() === 'MP') {
                            return 'MP';
                        }
                        break;
                    case 2:
                        if ($item->$method() === 'SP') {
                            return 'SP';
                        }
                        break;
                    case 3:
                        if ($item->$method() === 'LL') {
                            return 'LL';
                        }
                        break;
                }
            }
        }

        return NULL;
    }

    public function nextSize($currentSize)
    {
        $index = array_search($currentSize, $this->size);
        if ($index !== NULL) {
            $key = $index + 1;
            if (key_exists($key, $this->size)) {
                return $this->size[$key];
            }
        }
        return NULL;
    }

    public function getAllowedShippingMethodsQuery($size)
    {
        if (!$this->shipToCountry) {
            throw new Exceptions\ShippingDestinationNull;
        }
        $weight       = intval($this->getWeight());
        $shippingFrom = $this->continent == 'EU' ? 'UK' : 'US';
        return $this->shippingMethod
                        ->where('origin', $shippingFrom)
                        ->where('destination', $this->shipToCountry)
                        ->where('size', $size)
                        ->where('min_weight', '<=', $weight)
                        ->where('max_weight', '>=', $weight)
                        ->orderBy('fee', 'asc')
                        ->groupBy('service');
    }

    public function getAllowedShippingMethods()
    {
        $largestSize = $this->getLargestSize();
        $methods     = $this->getAllowedShippingMethodsQuery($largestSize)->get();
        //var_dump($largestSize);
        //var_dump(array_search($largestSize, $this->size));
        while (!count($methods) && (array_search($largestSize, $this->size) < (count($this->size) - 1))) {
            $largestSize = $this->nextSize($largestSize);
            $methods     = $this->getAllowedShippingMethodsQuery($largestSize)->get();
        }
        $methodsArr = [];
        foreach ($methods as $m) {
            $methodsArr[] = $m;
        }
        if ($this->shipToCountry == 'UK') {
            $freeShipSetting = Models\Setting::where('key', 'uk_free_shipping')->first();
            if ($freeShipSetting && $this->total() >= $freeShipSetting->value) {
                $freeMethod = ShippingMethod::createFreeShippingMethod();
                array_unshift($methodsArr, $freeMethod);
            }
        }

        return $methodsArr;
    }

    public function hasItem($id)
    {
        foreach ($this->items as $key => $item) {
            if($key == $id){
                return true;
            }
        }
        return false;
    }
}
