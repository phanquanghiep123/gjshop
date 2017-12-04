<?php

namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Illuminate\Http\Request;
use Modules\Shop\Models\DiscountCode;
use Modules\Shop\Models\Setting;
use Modules\Shop\Request\Vouchers\CreateVoucherRequest;
use DB;

/**
 * Description of DiscountController
 *
 * @author dinhtrong
 */
class PointsController extends ShopController
{

    public function convert(CreateVoucherRequest $request){
        
        $points_requested = $request->voucher_amount;
        $user = \Auth::user();

        // get the conversion rate from settings
        $rate = Setting::where('key','loyalty_points_ratio')->pluck('value')->first();

        // multiply the amount requested by the rate
        $points_needed = $points_requested * $rate;

        // Check user has enough points
        $users_current_points = $user->points;
        if( $users_current_points < $points_needed){
            return response('You have insufficient points, please try a lower amount.', 422);
            // return redirect()->back()->with('status', 'You have insufficient number of points, please try a lower amount.');
        }


        // Create the voucher

        $now = date('Y-m-d - h:i:s');

        $datetime = new \DateTime();
        $datetime->modify('+6 months');
        $datetime->format('Y-m-d - h:i:s');

        $new_code = new DiscountCode;
        $new_code->code             =  'LV'.$user->id.'-'.date('dhis');
        $new_code->multiple_use     =  '2';
        $new_code->discount_amount  =  $points_requested;
        $new_code->discount_type    =  'amount';
        $new_code->status           =  '1';
        $new_code->valid_from       =  $now;
        $new_code->valid_until      =  $datetime->format('Y-m-d - h:i:s');
        $new_code->user_id          =  $user->id;
        $new_code->created_by       =  $user->fullname() ;
        $new_code->save();


        // Remove the points from the users account
        $remaining_points = $users_current_points - $points_needed;
        DB::table('users')->where('id',$user->id) ->update(['points' => $remaining_points]);


        if ($request->ajax()) {
            if($new_code){
                $data = [
                    'voucher' => view('_partials.frontend.vouchers')->render(),
                    'accumulated_points' => view('_partials.frontend.accumulated_points')->render(),
                    'points_total' => view('_partials.frontend.points_total')->render(),
                    'message' => 'Your voucher was successfully created.'
                ];
                return response()->json($data);
            } else {
                return response('There was an error, please try again later.', 422);
            }
        }
    }





}
