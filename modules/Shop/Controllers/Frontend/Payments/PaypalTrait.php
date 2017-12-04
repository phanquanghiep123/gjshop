<?php

namespace Modules\Shop\Controllers\Frontend\Payments;

use Mail;
use Omnipay;
use Modules\Shop\Cart;
use Session;
use Illuminate\Http\Request;
use Modules\Shop\Models\Order;
use Modules\Shop\Models\DiscountCode;
use Modules\Shop\Models\Commission;
use DB;
use Omnipay\PayPal\PayPalItem;
use App\EmailTemplate;
use App\User;
use Stripe\Stripe; 
use Stripe\Charge;

/**
 * Description of PaypalTrait
 *
 * @author dinhtrong
 */
trait PaypalTrait
{

    public function checkoutWithStripe(Request $request)
    {
        $orderSaved = Order::where('token', $request->order)->first();
        if (!$orderSaved) {
            app()->abort(404);
        }
        /** @var $cart Modules\Shop\Cart */
        $cart = Cart::getCurrent();
        $shippingAbout = $cart->getShippingFee();
        $taxAmount = $cart->getTax();
        $currency = \Modules\Shop\CurrencySessionManager::getInstance()->getCurrency();
        $params = array(
            'cancelUrl' => $this->getCancelUrl(),
            'returnUrl' => $this->getPaypalReturnUrl($request),
            'amount'    => $cart->total() + $shippingAbout + $taxAmount,
            'currency'  => $currency,
        );
        $total = $cart->total() + $shippingAbout + $taxAmount;
        $stripe = $cart->Getstripe();
        $total = round($total * 100);
        Session::put('shop.checkoutParams', $params);
        Session::save();
        Stripe::setApiKey('rk_test_d2vAxjIiQcR9pqTDxYx6lmDA');
        $myCard = array('number' => $stripe["number_car"], 'exp_month' => $stripe["moth"], 'exp_year' => $stripe["year"], "cvc_year" => $stripe["cvc"]);
        $charge = Charge::create(array('card' => $myCard, 'amount' => $total, 'currency' => 'EUR'));
        $orderSaved->meta = json_encode($charge);
        $orderSaved->status = Order::PAYMENT_MADE_STATUS;
        $orderSaved->save();
        if($charge->status === 'succeeded') {
            return redirect()->route('shop.checkout.stripe_return',["order" => $request->order,"token" => $charge->id]);
        }else{
            return redirect()->route('shop.checkout.stripe_return',["order" => $request->order,"token" => $charge->id]);
        }
        
    }
    public function getStripeCheckoutReturn(Request $request, $order)
    {
        $orderSaved = Order::where('token', $order)->first();
        if (!$orderSaved) {
            app()->abort(404);
        }
        cart()->destroy();
        $user = User::find($orderSaved->user_id);
        $user->points -= $orderSaved->redeem_point;
        $user->save();
        $this->updateProductInventory();
        $this->updateDiscountStatus();
        if($orderSaved->points_earned > 0){
            \Log::info("save {$orderSaved->user_id} - {$orderSaved->points_earned}");
            DB::table('users')->where('id',$orderSaved->user_id)->increment('points', $orderSaved->points_earned);
        }
        $this->sendEmailConfirmation($orderSaved);
        // Check and apply one off commission
        $this->applyOneOffCommission($orderSaved);
        return view('shop::order.success')->with('order',$orderSaved->order_number);
    }
    public function checkoutWithPaypal(Request $request)
    {
        /** @var $cart Modules\Shop\Cart */
        $cart = Cart::getCurrent();
        $shippingAbout = $cart->getShippingFee();
        $taxAmount = $cart->getTax();
        $currency = \Modules\Shop\CurrencySessionManager::getInstance()->getCurrency();
        $params = array(
            'cancelUrl' => $this->getCancelUrl(),
            'returnUrl' => $this->getPaypalReturnUrl($request),
            'amount' => $cart->total() + $shippingAbout + $taxAmount,
            'currency' => $currency,
        );
        // die(var_dump($params));

        Session::put('shop.checkoutParams', $params);
        Session::save();

        $gateway = $this->getPaypalGeteway();

        $response = $gateway->purchase($params)
                ->setItems($this->getPaypalItemBag())
                ->setShippingAmount($cart->getShippingFee())
                ->send();

        if ($response->isRedirect()) {
            $response->redirect();
        } else {
            app()->abort(422, $response->getMessage());
        }
    }

    public function getPaypalCheckoutReturn(Request $request, $order)
    {

        $orderSaved = Order::where('token', $order)->first();
        if (!$orderSaved) {
            app()->abort(404);
        }

        $paypalResponse = $this->getPaypalResponse();
        
        \Log::info('respone', $paypalResponse);


        if (isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
            $orderSaved->meta = $paypalResponse;
            $orderSaved->status = Order::PAYMENT_MADE_STATUS;
            $orderSaved->save();
        } else {

            app()->abort(422, 'Failed transaction');
        }

         if($paypalResponse['ACK'] === 'Success') {

            // Update point redeem 2017/08/02
            $user = User::find($orderSaved->user_id);
            $user->points -= $orderSaved->redeem_point;
            $user->save();
            $this->updateProductInventory();
            $this->updateDiscountStatus();
            cart()->destroy();
            
            // Increment the users account with the points from the order unless the order was paid for my a voucher            
            if($orderSaved->points_earned > 0){
                \Log::info("save {$orderSaved->user_id} - {$orderSaved->points_earned}");
                DB::table('users')->where('id',$orderSaved->user_id)->increment('points', $orderSaved->points_earned);
            }

            $this->sendEmailConfirmation($orderSaved);

            // Check and apply one off commission
            $this->applyOneOffCommission($orderSaved);

        }


        return view('shop::order.success')->with('order',$orderSaved->order_number);
    }

    protected function getPaypalItemBag()
    {
        $items = new \Omnipay\Common\ItemBag();
        if (cart()->total() > 0) {
            foreach (cart()->getItems() as $item) {
                $items->add(new PayPalItem([
                    'name' => $item->getName(),
                    'price' => $item->getPrice(),
                    'quantity' => $item->getQuantity()
                ]));
            }
            foreach (cart()->getCourses() as $course) {
                $items->add(new PayPalItem([
                    'name' => $course->title,
                    'price' => $course->price,
                    'quantity' => 1
                ]));
            }

            $discount = cart()->discountTotal();
            if ($discount) {
                $items->add(new PayPalItem([
                    'name' => 'Discount',
                    'price' => -$discount,
                    'quantity' => 1
                ]));
            }

            $redeemTotal = cart()->getRedeemTotal();
            if ($redeemTotal) {
                $items->add(new PayPalItem([
                    'name' => 'Redeem',
                    'price' => -$redeemTotal,
                    'quantity' => 1
                ]));
            }
        }
        return $items;
    }

    protected function getPaypalReturnUrl(Request $request)
    {
        return route('shop.checkout.paypal_return', ['order' => $request->input('order')]);
    }

    protected function updateProductInventory()
    {
        $items = cart()->getItems();
        foreach ($items as $id => $item) {
            DB::table('shop_products')->where('id', $id)
                    ->update(['inventory' => DB::raw('`inventory` - ' . $item->getQuantity())]);
        }
    }

    protected function updateDiscountStatus()
    {
        if (cart()->getDiscount()) {
            $id = cart()->getDiscount()->id;
            $voucher = DiscountCode::find($id);
            if ($voucher->multiple_use != 1) {
                $voucher->status = '2';
                $voucher->used_date = date('Y-m-d H:i:s');
                $voucher->save();
            }
        }
    }

    protected function sendEmailConfirmation($order)
    {
        
        $customer = User::find($order->user_id);

        $template = EmailTemplate::where('name','order-confirmation')->first(); 

        $placeholders = array('{username}', '{points}');
        $replacements = array($customer->f_name, $order->points_earned);
        $str          = $template->email;
        $clean_message      = str_replace($placeholders, $replacements, $str);


        $data = [];
        $data['message'] = $clean_message;
        $data['subject'] = $template->subject;
        $data['to_email'] = $order->invoice_email;

        Mail::send('emails.'.$template->template, ['data' => $data,'order'=>$order,'customer'=>$customer], function ($m) use ($data) {
            $m->from('no-reply@nurturedforliving.com','Nurtured For Living');
            $m->to($data['to_email']);
            $m->bcc('info@nurturedforliving.com');
            $m->subject($data['subject']);
        });
    }

    protected function getPaypalResponse()
    {
        $gateway = $this->getPaypalGeteway();
        $params = Session::get('shop.checkoutParams');
        $response = $gateway->completePurchase($params)->send();
        return $response->getData();
    }

    protected function getPaypalGeteway()
    {
        $gateway = Omnipay::gateway('paypal');
        $gateway->setUsername(config('shop.paypal.username'));
        $gateway->setPassword(config('shop.paypal.password'));
        $gateway->setSignature(config('shop.paypal.signature'));
        $gateway->setTestMode(config('shop.paypal.sandbox'));
        return $gateway;
    }

    private function applyOneOffCommission($order)
    {
       $check_first_order = Order::where('user_id',$order->user_id)
                                    ->whereIn('status',array(Order::PAYMENT_MADE_STATUS,Order::SHIPPING_STATUS,Order::COMPLETED_STATUS))
                                    ->where('id','!=',$order->id)
                                    ->first();
       if($check_first_order){
            return false;
       } else {
            $referrer = User::where('username',$order->voucher)->first();
            
            if($referrer && $referrer->advocate!='1'){

                $data['referrer_id']    =   $referrer->id; 
                $data['referral_id']    =   $order->user_id;
                $data['order_id']       =   $order->id;
                $data['commission']     =   10 * $order->price / 100;
                $data['status']         =   Commission::PENDING;

                $assign_commission = Commission::create($data);
            } else {
                return false;
            }
       }
    }
}
