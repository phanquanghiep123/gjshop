<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Illuminate\Http\Request;
use App\User;
use Modules\Shop\Models\Order;
use Modules\Shop\Models\DiscountCode;

/**
 * Description of DiscountController
 *
 * @author dinhtrong
 */
class DiscountController extends ShopController
{

    public function apply(Request $request)
    {
        if (cart()->getDiscount()) {
            return response(' You can only use ONE coupon', 400);
        }
        $code = $request->get('code');

        if (!$code) {
            return response('Please enter the coupon code!', 400);
        }

        $discountFound = DiscountCode::where('code', $code)->first();

        if (!$discountFound) {
            return response('This coupon code is invalid', 400);
        } elseif($discountFound->status != DiscountCode::ACTIVE ) {
            return response('This coupon code has expired', 400);
        }

        $discount = $discountFound;

        switch ($discount) {


            // Check if coupon a referrers discount code for a one off commission

            case $discount->commissionable == DiscountCode::COMMISSIONABLE :

                // CHECK ITS USERS FIRST ORDER

            
                $email = ( \Auth::check() ? \Auth::user()->email : 'email@email.com');

                $user = User::where('email',$email)->first();

                if($user){
                    $previuos_order = Order::where('user_id',$user->id)
                                        ->whereIn('status',array(Order::PAYMENT_MADE_STATUS,Order::SHIPPING_STATUS,Order::COMPLETED_STATUS,Order::REFUNDED_STATUS))
                                        ->first();

                    if($previuos_order){
                        return response('Sorry but you are not able to use this referrer code!', 400);
                    }
                } else {

                    cart()->setDiscount($discount);
                    $data = [
                        'cartContent' => view('shop::_partials.cart.cartFormContent')->render(),
                        'discount' => cart()->discountTotal(),
                        'redeem' => cart()->getRedeemTotal(),
                        'total' => cart()->total()
                    ];
                    return response()->json($data);
                }                

                break;

            // ===================================================================


            // Check if coupon is assigned to a specific user first

            case $discount->assigned_to_user != NULL :

                if (\Auth::check()) {

                    if ($this->isValidUser($discount)) {
                        cart()->setDiscount($discount);
                        $data = [
                            'cartContent' => view('shop::_partials.cart.cartFormContent')->render(),
                            'discount' => cart()->discountTotal(),
                            'redeem' => cart()->getRedeemTotal(),
                            'total' => cart()->total()
                        ];
                        return response()->json($data);
                    } else {
                        return response('You do not have permission to use coupon code "' . $code . '" ', 400);
                    }

                    // return response('logged in', 400);
                } else {
                    return response('You must login to use this coupon code', 400);
                }

                break;

            // ===================================================================
            // Check if it has a use by data or if its open
            // check multi or single use

            case $discount->assigned_to_user == NULL :

                // check if it has an expiry date 
                if ($discount->valid_until != NULL && !$this->isValidDate($discount)) {
                    return response('The coupon code "' . $code . '" has expired!', 400);
                } else {
                    cart()->setDiscount($discount);
                    $data = [
                        'cartContent' => view('shop::_partials.cart.cartFormContent')->render(),
                        'discount' => cart()->discountTotal(),
                        'redeem' => cart()->getRedeemTotal(),
                        'total' => cart()->total()
                    ];
                    return response()->json($data);
                }

                break;

            // ===================================================================


            default:
                # code...
                break;
        }
    }

    public function remove()
    {
        if (!cart()->getDiscount()) {
            return response(' You do not have any coupon', 400);
        }
        cart()->removeDiscount();
        return view('shop::_partials.cart.cartFormContent');
    }

    private function isValidDate($discount)
    {
        if ($discount->valid_until == NULL) {
            return true;
        }
        return  $discount->valid_from && $discount->valid_until &&
                $discount->valid_from <= \Carbon\Carbon::now()->format('Y-m-d H:i:s') &&
                \Carbon\Carbon::now()->format('Y-m-d H:i:s') <= $discount->valid_until;
    }

    private function isValidUser($discount)
    {
        if ($discount && $discount->assigned_to_user != NULL) {
            return (int) $discount->assigned_to_user == \Auth::user()->id;
        } else {
            return false;
        }
    }

}
