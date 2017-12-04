<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use App\SiteSetting;
use App\Newsletter;
use App\Http\Requests\Frontend\Profiles\CreateAccountRequest;
use App\Http\Requests\Frontend\Profiles\PasswordResetRequest;
use App\EmailTemplate;
use Illuminate\Support\Facades\Mail;



class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

use AuthenticatesAndRegistersUsers,
    ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $loginPath  = 'login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->middleware('guest', ['except' => 'logout']);
        \View::share('settings', SiteSetting::getSettingObject());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name'     => 'required|max:255',
                    'email'    => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
        ]);
    }

    protected function authenticated(Request $request, $user) {

        $intended = \Request::server('HTTP_REFERER');

        $last_login  = $user->last_login;
        $last_login2 = $user->last_login2;
        if ($last_login < $last_login2) {
            $user->last_login = date("Y-m-d H:i:s");
            $user->ip         = $request->getClientIp();
            $user->save();
        } else {
            $user->last_login2 = date("Y-m-d H:i:s");
            $user->ip          = $request->getClientIp();
            $user->save();
        }
        //if($request->has('redirectTo')){
        //    $this->redirectTo = $request->input('redirectTo');
        //}
        //return redirect()->intended($this->redirectPath());

        //if( $user->is('user') || ){
          return redirect()->to($intended);
        //}
    }
    
    public function ajaxLogin(Request $request){
        $return = ['result'=> false,'message'=>'Invalid Email Address or Password'];
        if (\Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')],$request->input('remember'))) {
            $return = [
                'result' => true,
                'message' => ''
            ];
        }
        return response()->json($return);
    }


    protected function register(CreateAccountRequest $request) {

        $data = $request->all();
        $data['last_login'] = date("Y-m-d H:i:s");
        $data['ip']         = $request->getClientIp();
        $data['email']      = trim($request->input('email_address'));
        $data['status']     = '1';
        $data['password'] = \Hash::make($request->register_password);
        $user = User::create($data);

        // check if user subcribed to notification and attach to user

        \DB::table('shop_stock_notification')
            ->where('email',$data['email'])
            ->update(['user_id' => $user->id]);

        // Automatically sign them upto the newsletter

        $newsletter_check = Newsletter::where('signup_email',$request->input('email_address'))->first();
        if(! $newsletter_check){
            $signup_data = [
                'signup_email' => $request->input('email_address'),
                'signup_name' => $request->input('f_name') . ' ' . $request->input('l_name'),
                'status' => '1'
            ];
            Newsletter::create($signup_data);
        }
         
        // Send them the registration email

        $template = EmailTemplate::where('name','user-registration-welcome')->first(); 
        $data = [];

        $placeholders = array('{email}','{password}','{username}');
        $replacements = array($user->email, $request->register_password, $user->f_name);
        $str = $template->email;
        $message =  str_replace($placeholders,$replacements,$str);

        $data['message'] = $message ;
        $data['subject'] = $template->subject;
        $data['to_email'] = $user->email;
        $data['username'] = $template->subject;

        Mail::send('emails.'.$template->template, ['data' => $data], function ($m) use ($data) {
            $m->from('no-reply@nurturedforliving.com','Nurtured For Living');
            $m->to($data['to_email']);
            $m->subject($data['subject']);
        });

        $user_role = Role::where('slug','user')->first();
        $user->roles()->attach($user_role->id);

        \Auth::attempt(['email' => $request->input('email_address'), 'password' => $request->input('register_password')]);
        if($user){
            return redirect()->to(route('my_account'));
        } else {
            return redirect()->back()->with('status','There was an error creating your account, please try again.');
        }
        
    }

    protected function password_reset(PasswordResetRequest $request) {

        $data = $request->all();
        
    }

    public function logout(Request $request){
        $intended = url('/');
        \Auth::logout();
        return redirect()->to($intended);

    } 

}
