<?php

namespace Modules\Shop\Models;

use Modules\Shop\Models\Order;
use DB;

/**
 * Description of OrderTrait
 *
 * @author dinhtrong
 */
class Commission extends Model {

    const PENDING = 0;
    const PAID = 1;
    
    protected $fillable = ['referrer_id','referral_id','order_id','commission','status'];
    protected $table = 'referral_commissions';

    public static function monthly_orders(){
        
        $referral_ids = DB::table('referrers')->where('referrer_id',\Auth::id())->pluck('referral_id');
        $date = date('Y-m-01 00:00:00');
        $orders = Order::leftJoin('users', 'users.id', '=', 'shop_orders.user_id')
                        ->select('users.f_name','users.l_name','shop_orders.price as amount','shop_orders.created_at as order_date')
                        ->whereIn('shop_orders.user_id',$referral_ids)
                        ->whereIn('shop_orders.status',array(Order::PAYMENT_MADE_STATUS,Order::SHIPPING_STATUS,Order::COMPLETED_STATUS))
                        ->where('shop_orders.created_at','>',$date)
                        ->get();

        return $orders;
    }


    public static function monthly_orders_total(){
        
        $referral_ids = DB::table('referrers')->where('referrer_id',\Auth::id())->pluck('referral_id');
        $date = date('Y-m-01 00:00:00');
        $orders_total = Order::leftJoin('users', 'users.id', '=', 'shop_orders.user_id')
                        ->select('shop_orders.price as amount')
                        ->whereIn('shop_orders.user_id',$referral_ids)
                        ->whereIn('shop_orders.status',array(Order::PAYMENT_MADE_STATUS,Order::SHIPPING_STATUS,Order::COMPLETED_STATUS,))
                        ->where('shop_orders.created_at','>',$date)
                        ->sum('shop_orders.price');

        return $orders_total;
    }


    public static function one_off_commissions($userId){

        $commission = Commission::where('referrer_id',$userId)
                        ->where('status',Commission::PENDING)
                        ->sum('commission');

        return $commission;
    }

}
