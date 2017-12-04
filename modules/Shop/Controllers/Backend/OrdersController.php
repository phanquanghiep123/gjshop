<?php

namespace Modules\Shop\Controllers\Backend;

use Modules\Shop\Controllers\ShopController;
use Modules\Shop\Request\Orders\CreateOrderRequest;
use Modules\Shop\Request\Orders\UpdateOrderRequest;
use Modules\Shop\Models\Order;
use Modules\Shop\Models\ShippingMethod;
use App\Courier;
use App\EmailTemplate;
use Mail;

class OrdersController extends ShopController {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $orders = Order::orderBy('created_at','DESC')->paginate(20);

        $index = $orders->firstItem();

        return view('shop::backend.orders.index', compact('orders', 'index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $users = \App\User::select( \DB::raw('id,concat(f_name, " ",l_name) AS name'))->lists('name','id')->toArray();
        $users = array_prepend($users,'Guest',0);
        return view('shop::backend.orders.create',  compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request) {
        $order = Order::create($request->all());

        return redirect()->route('gjadmin.shop.orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $order = Order::findOrFail($id);

        return view('shop::backend.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $order = Order::findOrFail($id);
        $users = \App\User::select( \DB::raw('id,concat(f_name, " ",l_name) AS name'))->lists('name','id')->toArray();
        $users = array_prepend($users,'Guest',0);
        return view('shop::backend.orders.edit', compact('order','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update( UpdateOrderRequest $request, $id ) {

        $order = Order::findOrFail($id);
        $orderData = $request->all();

        if( isset($request->send_update_email) && $request->send_update_email == '1' && ( $request->status == '0' || $request->status == '1' || $request->status == '3') ){
            return back()->withInput()->with('status','When sending email updates, the order staus must be SHIPPED or REFUNDED.');
        }
        
        $shippingMethod = ShippingMethod::find($request->shipping_method_id);
        $courier = Courier::find( $shippingMethod->courier_id);
        if($courier){
            $orderData['shipping_method_name']   = $courier->name ;
            $orderData['courier']                = $courier->name ;
        }

        if( isset($request->send_update_email) && $request->send_update_email == '1' && ($request->status == '2' || $request->status == '4' || $request->status == '5') ){

            // Send update email

            if($request->status == '2'){

                $templateModel = $request->tracked == '1' ? 'order-status-update-trackable'  :  'order-status-update-untrackable' ;

            } elseif ($request->status == '4') {
                
                $templateModel = 'order-cancelled';

            } else {
                
                $templateModel = 'order-refunded';

            }
         

            $template = EmailTemplate::where('name',$templateModel)->first(); 
            $data = [];

            // Plcaeholder Data

            $user = \App\User::find($order->user_id);

            $placeholders = array(
                '{username}',
                '{order_number}',
                '{order_date}',
                '{courier}',
                '{tracking_number}',
                '{url}',
                '{duration}',
            );
            
            $replacements = array(
                $user->f_name,
                $order->order_number,
                date('D, d M Y - H:i',strtotime( $order->created_at )),
                $courier->name,
                $request->tracking_ref,
                $courier->website,
                $shippingMethod->duration,

            );

            $str = $template->email;
            $message =  str_replace($placeholders,$replacements,$str);
            $updatedSubject = str_replace('{order_number}',$order->order_number,$template->subject);

            $data['message'] = $message ;
            $data['subject'] = $updatedSubject;
            $data['to_email'] = $order->invoice_email;
            $data['username'] = $template->subject;

            Mail::send('emails.'.$template->template, ['data' => $data], function ($m) use ($data) {
                $m->from('no-reply@nurturedforliving.com','Nurtured For Living');
                $m->to($data['to_email']);
                $m->subject($data['subject']);
            });

            if( $request->send_update_email == '1' && $request->status == '2' && $order->email_shipped == '0' ){
                $orderData['email_shipped'] = '1';
                $orderData['email_cancelled'] = '0';
                $orderData['email_refunded'] = '0';
            } elseif( $request->send_update_email == '1' && $request->status == '4' && $order->email_cancelled == '0' ){
                $orderData['email_shipped'] = '0';
                $orderData['email_cancelled'] = '1';
                $orderData['email_refunded'] = '0';
            } elseif( $request->send_update_email == '1' && $request->status == '5' && $order->email_refunded == '0' ){
                $orderData['email_shipped'] = '0';
                $orderData['email_cancelled'] = '0';
                $orderData['email_refunded'] = '1';
            }
        }

        
        if( $request->tracked == '0' ){
            $orderData['tracking_ref'] = null;
        }

        $orderData['ship_date'] = ( $orderData['ship_date'] == '' ? NULL : $orderData['ship_date'] );

        $order->update($orderData);

        return redirect()->back()->with('message','The order was successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $order = Order::findOrFail($id);

        $order->delete();

        return redirect()->route('gjadmin.shop.orders.index')->with('message','The Order #' . $order->token  . ' was successfully deleted.');
    }

}
