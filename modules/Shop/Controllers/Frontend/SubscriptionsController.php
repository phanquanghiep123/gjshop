<?php

namespace Modules\Shop\Controllers\Frontend;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\User;
use Modules\Shop\Request\Subscriptions\SubscribeStockDeliveredRequest;
use Modules\Shop\Controllers\ShopController;
use Modules\Shop\Models\StockNotificationEmail;
use Modules\Shop\Models\Product;


/**
 * Description of SubscriptionsController
 *
 * @author dinhtrong
 */
class SubscriptionsController extends ShopController {

    public function subscribeStockDelivered(SubscribeStockDeliveredRequest $request) {
        $data = $request->all();

        if(\Auth::check()){
            $email = \Auth::user()->email;
            $data['user_id'] = \Auth::user()->id;
        } else {
            $email =  $data['email'];
        }

        $data['status'] = 1;
        $product_id = $data['product_id'];
        $product = Product::find($product_id);

        $checkSubscribed = StockNotificationEmail::where('email',trim($email))
                                                ->where('product_id',$product_id)
                                                ->where('status',StockNotificationEmail::ACTIVE)->first();
        
        if($checkSubscribed){
            return response("You are already subsrcibed to stock notifications for ".$product->name,422);
        }else{
            $result = StockNotificationEmail::create($data);
            if($result){
                return response()->json(['message'=> 'You will be emailed when ' . $product->name . ' arrives back in stock.']);
            }else{
                return response("Something went wrong, please try again",422);
            }
            
        }
    }

}
