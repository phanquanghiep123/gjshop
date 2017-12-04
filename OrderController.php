<?php
namespace Modules\Shop\Controllers\Frontend;

use Modules\Shop\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\EmailTemplate;
use App\Newsletter;
use App\User;
use App\Courier;
use App\CustomerAddress;
use Illuminate\Support\Facades\Mail;
use Modules\Shop\Cart;
use Modules\Shop\Models\Order;
use Modules\Shop\Models\ShippingMethod;
use Modules\Shop\Models\Commission;
use App\Services\RandomStringGenerator;
use Modules\Shop\CurrencySessionManager;
use Modules\Shop\Request\Orders\CreateOrderRequest;

/**
 * Description of OrderController
 *
 * @author dinhtrong
 */
class OrderController extends ShopController
{

    protected $order;
    protected $shippingMethod;

    public function __construct(Order $order, ShippingMethod $shippingMethod)
    {
        parent::__construct();
        $this->order          = $order;
        $this->shippingMethod = $shippingMethod;
    }

    public function create()
    {

        return view('shop::order.create', compact('shippingMethods'));
    }

    public function store(CreateOrderRequest $request)
    {

        // automatically enrol them in our newslatter
        $newsletter_check = Newsletter::where('signup_email', $request->input('email'))->first();
        if (!$newsletter_check) {
            $signup_data = [
                'signup_email' => $request->input('email'),
                'signup_name'  => $request->input('f_name') . ' ' . $request->input('l_name'),
                'status'       => '1'
            ];
            Newsletter::create($signup_data);
        }
        $shippingMethodId = $request->input('shipping_method', 0);
        cookie()->queue(cookie()->forever('cart', []));
        if ($request->has('register') && $request->input('register')) {
            $result = $this->registerUser($request);
            if (!$result['success']) {
                return response()->json(['errors' => $result['messages']], 422);
            }
            $userId = \Auth()->user()->id;
        } else {
            // Check if the user has an account. if not create one and send them the password.
            // If they do then do nothing
            $accountCheck = User::where('email', $request->input('email'))->first();
            if (!$accountCheck) {
                $password = generateStrongPassword();
                $user     = \App\User::create([
                    'f_name'     => $request->input('f_name'),
                    'l_name'     => $request->input('l_name'),
                    'email'      => $request->input('email'),
                    'mobile'     => $request->input('phone'),
                    'last_login' => date('Y-m-d h:i:s'),
                    'ip'         => $request->getClientIp(),
                    'password'   => Hash::make($password),
                ]);
                $userRole = \App\Role::where('slug', 'user')->first();
                $roles    = array($userRole->id);
                $user->roles()->sync($roles);

                \Auth::login($user);

                // Send welcome email with username and password

                $template = EmailTemplate::where('name', 'user-registration-welcome')->first();
                $data     = [];

                $placeholders = array('{email}', '{password}', '{username}');
                $replacements = array($request->get('email'), $password, $request->get('f_name'));
                $str          = $template->email;
                $message      = str_replace($placeholders, $replacements, $str);

                $data['message']  = $message;
                $data['subject']  = $template->subject;
                $data['to_email'] = $request->get('email');
                $data['username'] = $template->subject;

                Mail::send('emails.' . $template->template, ['data' => $data], function ($m) use ($data) {
                    $m->from('no-reply@nurturedforliving.com', 'Nurtured For Living');
                    $m->to($data['to_email']);
                    $m->subject($data['subject']);
                });
            }

            if ($accountCheck) {
                $userId = $accountCheck->id;
            } else {
                $userId = ( $user ? $user->id : ( $request->input('user_id') != '' ? $request->input('user_id') : 0 ));
            }
        }

        $cart = Cart::getCurrent();

        $redeem = $cart->redeem;
        $this->setShippingMethod($cart, $shippingMethodId);
        $price   = $cart->total() ;
        $shipFee = $shippingMethodId ? $cart->getShippingFee() : 0;
        $taxt    = $cart->getTax();


        // If it's the customers first order save address or
        // If it's not the first order but they have checked the save address box, save address

        if(!$accountCheck || $request->input('save_address_question') ==1){
            // If new customer save address in their addresses and in the order.
            $address_data['country']    = $request->input('country', null);
            $address_data['city']       = $request->input('city_state', null);
            $address_data['zip_code']   = $request->input('zip_code', null);
            $address_data['address']    = $request->input('address', null);
            $address_data['town']       = $request->input('town', null);
            $address_data['name']       = $request->input('name');
            $address_data['user_id']    = ( isset($user) ? $user->id : \Auth::id());
            $address_data['default']    = (!$accountCheck ? '1' : ( $request->input('make_default') ==1 ? '1' : '0'));

            $save_address = CustomerAddress::create($address_data);

            if($request->input('make_default') ==1){
                CustomerAddress::where('user_id',$save_address->user_id)
                ->whereNotIn('id',array($save_address->id))
                ->update(['default' => '0']);
            }

        }
            
        $customerName          = $request->input('customer_name') ? $request->input('customer_name') : $request->input('f_name') . ' ' . $request->input('l_name');
        $customerContactNumber = $request->input('phone', null);
        $invoiceEmail          = $request->input('email');
        $customerNote          = $request->input('customer_note');
        $orderContactNo        = $request->input('customer_phone');

        $customerCountry       = $request->input('country', null);
        $customerCity          = $request->input('city_state', null);
        $zipCode               = $request->input('zip_code', null);
        $customerAddress       = $request->input('address', null);
        $customerTown          = $request->input('town', null);


        $deliveryFee = number_format(cart()->getShippingFee(), 2);
        $discount    = cart()->getDiscount();
        $discountAmount = 0;
        if ($discount) {
            $discountAmount = number_format(cart()->discountTotal(), 2);
        }

        if ($shippingMethodId) {
            $shippingMethod = ShippingMethod::find($shippingMethodId);
            $courier        = Courier::find($shippingMethod->courier_id);
            if ($shippingMethod) {
                $shippingMethodName = $shippingMethod->name;
            } else {
                $shippingMethodName = null;
            }
            if ($courier) {
                $courierName = $courier->name;
            } else {
                $courierName = null;
            }
        } else {
            $shippingMethodName = null;
            $courierName        = null;
        }

        $token = $this->generateOrderToken();
       
        $this->order->create([
            'price'                => $price,
            'ship_fee'             => $shipFee,
            'taxt'                 => $taxt,
            'invoice_email'        => $invoiceEmail,
            'order_contact_no'     => $orderContactNo,
            'customer_name'        => $customerName,
            'customer_address'     => $customerAddress ?: '',
            'customer_country'     => $customerCountry ?: '',
            'customer_city'        => $customerCity ?: '',
            'zip_code'             => $zipCode ?: '',
            'customer_phone'       => $customerContactNumber ?: '',
            'token'                => $token,
            'user_id'              => $userId,
            'customer_note'        => $customerNote,
            'currency'             => CurrencySessionManager::getInstance()->getCurrency(),
            'items'                => $this->createItemsDataForOrder(),
            'courier'              => $courierName,
            'shipping_method_id'   => $shippingMethodId,
            'shipping_method_name' => $shippingMethodName,
            'voucher'              => $discount ? $discount->code : null,
            'discount'             => $discountAmount,
            'delivery'             => $deliveryFee ? $deliveryFee : null,
            'points_earned'        => $this->pointsEarnedForOrder(), // 1 point for every £ spent
            'redeem'               => $redeem ["use"],
            'redeem_price'         => $redeem ["price"],
            'redeem_point'         => $redeem ["points"],
            'method_pay'           => $request->input("payment_method"),
        ]);
        if($request->input("payment_method") == "paypal"){
            return response()->json(['redirect' => route('shop.checkout.paypal', ['order' => $token])]);
        }elseif($request->input("payment_method") == "stripe"){
            $cart->Setstripe($request->input('stripe'));
            return response()->json(['redirect' => route('shop.checkout.stripe', ['order' => $token])]);
        }
    }

    private function createItemsDataForOrder()
    {
        $data = [];
        foreach (cart()->getItems() as $id => $item) {
            $idata  = [
                'id'       => $id,
                'name'     => $item->getName(),
                'quantity' => $item->getQuantity(),
                'price'    => $item->getPrice(),
                'slug'     => $item->getSlug(),
                'points'   => $item->getPoints()
            ];
            $data[] = $idata;
        }
        return $data;
    }


    private function pointsEarnedForOrder()
    {
 
        $points = 0;

        $cart = Cart::getCurrent();

        $redeem = $cart->redeem;

        $discount = cart()->getDiscount();

        if( $redeem['use']=='1' || $discount ){


            $points = floor($cart->total());


        } else {

            foreach (cart()->getItems() as $id => $item) {

               $multipleItems = $item->getPoints() * $item->getQuantity();

               $points += $multipleItems;
            }

        }
        return $points;
    }


    private function registerUser(Request $request)
    {
        $result          = [
            'success'  => true,
            'messages' => []
        ];
        $email           = $request->get('email');
        $password        = $request->input('password');
        $confirmPassword = $request->input('confirm_password');
        $checkEmailExist = \App\User::where('email', $email)->count();
        if ($checkEmailExist) {
            $result['success']    = false;
            $result['messages'][] = "The email address is already registered in the system";
        } elseif ($password !== $confirmPassword) {
            $result['success']    = false;
            $result['messages'][] = 'Password does not match the confirm password';
        } else {
            $user     = \App\User::create([
                        'f_name'     => $request->input('f_name'),
                        'l_name'     => $request->input('l_name'),
                        'email'      => $email,
                        'mobile'     => $request->input('phone'),
                        'last_login' => date('Y-m-d h:i:s'),
                        'ip'         => $request->getClientIp(),
                        'password'   => bcrypt($password),
            ]);
            $userRole = \App\Role::where('slug', 'user')->first();
            $roles    = array($userRole->id);
            $user->roles()->sync($roles);


            // Send welcome email with username and password

            $template = EmailTemplate::where('name', 'user-registration-welcome')->first();
            $data     = [];

            $placeholders = array('{email}', '{password}', '{username}');
            $replacements = array($user->email, $password, $user->f_name);
            $str          = $template->email;
            $message      = str_replace($placeholders, $replacements, $str);

            $data['message']  = $message;
            $data['subject']  = $template->subject;
            $data['to_email'] = $user->email;
            $data['username'] = $template->subject;

            Mail::send('emails.' . $template->template, ['data' => $data], function ($m) use ($data) {
                $m->from('no-reply@nurturedforliving.com', 'Nurtured For Living');
                $m->to($data['to_email']);
                $m->subject($data['subject']);
            });


            \Auth::login($user);
            $result['success'] = true;
        }
        return $result;
    }

    private function setShippingMethod(Cart $cart, $methodId)
    {
        if (!$cart->isHaveCoursesOnly()) {
            $method = $methodId ?
                    $this->shippingMethod->find($methodId) :
                    ShippingMethod::createFreeShippingMethod();
            $cart->setShippingMethod($method);
        }
    }

    private function generateOrderToken()
    {
        $generator = new RandomStringGenerator('0123456789');
        return $generator->generate(5) . uniqid();
    }

    public function viewHistory()
    {
        $this->middleware('auth');
        $orders = auth()->user()->getOrdersQuery()->paginate(10);
        return view('shop::order.history', compact('orders'));
    }

    public function orderDetails(Request $request, $token)
    {
        $this->middleware('auth');

        $order = auth()->user()->getOrdersQuery()->where('token', $token)->first();
        return view('shop::order.order_details', compact('order'));
    }

    public function delete_order(Request $request, $id)
    {
        $this->middleware('auth');

        $order = auth()->user()->getOrdersQuery()->where('id', $id)->first();
        $order->delete();

        return redirect()->back()->with('message', 'The order was successfully deleted.');
    }

    public function checkPostcode($postCode)
    {
        $data = \Postcode::lookup($postCode);
        
        return response()->json($data);
    }

}
