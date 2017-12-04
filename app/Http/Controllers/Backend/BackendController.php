<?php

namespace App\Http\Controllers\Backend;
use App;
use App\Http\Controllers\Controller as Controller;
use Session;
use App\SiteSetting;
use Illuminate\Http\Request;
use Modules\Shop\Models\Order;
use Modules\Shop\Models\ProductReview;
use Modules\Shop\Models\Product;

class BackendController extends Controller
{
    public function __construct() {
       parent::__construct();
    }


    // MAIN DASHBOARD FOR MAIN ADMIN ONLY

    public function dashboard()
    {

        $ordersAwaitingPost = Order::awaitingPostage()->count();
        $pendingReviews = ProductReview::pending()->count();
        $lowInventory = Product::lowInventory()->count();

        return view('backend.index',compact('ordersAwaitingPost','pendingReviews','lowInventory'))->with('title','Staff Control Panel');
    }

    public function settings()
    {	
    	$settings = SiteSetting::find(1);
        return view('backend.settings',compact('settings'))->with('title','Site Settings');
    }
    public function update_settings(Request $request)
    {	
    	$settings = SiteSetting::first();
    	$settings->update($request->all());
    	return Redirect()->back()->with('message','The settings were successfully updated.');

    }
    

}
