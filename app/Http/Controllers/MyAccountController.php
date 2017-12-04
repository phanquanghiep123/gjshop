<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
use App\Role;
use App\User;
use App\Referrer;
use App\CustomerAddress;
use Modules\Shop\Models\Order;
use Modules\Shop\Models\Commission;
use App\Http\Requests\Frontend\Profiles\UpdateProfileRequest;
use App\Http\Requests\Frontend\Referrals\AddReferralRequest;

/**
 * Description of PageController
 *
 * @author dinhtrong
 */
class MyAccountController extends Controller {

    private $user;
    private $role;

    public function __construct(User $user, Role $role) {
        parent::__construct();
        $this->user = $user;
        $this->role = $role;
    }



    /**************
     * USER LINKS
     * ************ */

    public function my_account() {
        return view('account_pages.my_account');
    }

    public function my_subscriptions() {
        return view('account_pages.my_subscriptions');
    }

    public function my_favorites() {
        return view('account_pages.my_favorites');
    }

    public function my_referrals() {
        return view('account_pages.my_referrals');
    }

    public function my_commissions() {

        $orders = Commission::monthly_orders();

        $monthly_orders_total = Commission::monthly_orders_total();

        return view('account_pages.my_commissions')->with('orders',$orders)->with('monthly_orders_total',$monthly_orders_total);
    }

    public function my_points() {
        return view('account_pages.my_points');
    }

    public function add_referral() {
        return view('account_pages.add_referral');
    }

    public function save_referral(AddReferralRequest $request) {
        
        $data = $request->all();
        $generated_password = generateStrongPassword();
        $data['password'] = \Hash::make($generated_password);
        $data['username'] = $generated_password;
        $new_user = User::create($data);


        // Add the users role
        $user_role = Role::where('slug','user')->first();
        $new_user->roles()->attach($user_role->id);


        // Link the referral account
        $referral_data = [];
        $referral_data['referrer_id'] = \Auth::id();
        $referral_data['referral_id'] = $new_user->id;
        $log_referral = Referrer::create($referral_data);



        // Send them the registration email
/*
        $template = EmailTemplate::where('name','referral-account-created')->first(); 
        $data = [];

        $placeholders = array('{email}','{password}','{username}','{referrer_name}');
        $replacements = array($data->email, $generated_password, $data->f_name,\Auth::user()->f_name);
        $str = $template->email;
        $message =  str_replace($placeholders,$replacements,$str);

        $data['message'] = $message ;
        $data['subject'] = $template->subject;
        $data['to_email'] = $user->email;

        Mail::send('emails.'.$template->template, ['data' => $data], function ($m) use ($data) {
            $m->from('no-reply@nurturedforliving.com','Nurtured For Living');
            $m->to($data['to_email']);
            $m->subject($data['subject']);
        });

*/
        return response()->json(['message'=> ' The referral was successfully added.']);

    }
    

    /**************
     * USER ACCOUNT
     **************/


    public function edit_account() {
        return view('account_pages.edit_account');
    }

    public function updateProfile(UpdateProfileRequest $request) {
        $data = $request->except('password');
        if ($request->password != '') {
            $data['password'] = \Hash::make($request->password);
        }

        $data['author_bio_review'] = ( isset($request->author_bio_review) == 1 ? '1' : '0' );

        $profile = \Auth::user();
        $avatar = $this->uploadAvatar($request);
        if ($avatar) {
            $data['avatar'] = $avatar;
        }
        $profile->update($data);
        return redirect()->back()->with('message', 'Your profile was successfully updated.');
    }

    private function uploadAvatar(UpdateProfileRequest $request) {
        if ($request->hasFile('avatar')) {
            $user = $request->user();
            $avatar = $request->file('avatar');
            $userFolder = public_path('users' . DIRECTORY_SEPARATOR . $user->id);
            $avatarFolder = $userFolder . DIRECTORY_SEPARATOR . 'avatar';
            if (!\File::exists($avatarFolder)) {
                \File::makeDirectory($avatarFolder,0775,true);
            }
            \File::cleanDirectory($avatarFolder);
            $name = 'avatar.' . $avatar->getClientOriginalExtension();
            $avatar->move($avatarFolder, $name);
            return 'users/' . $user->id . '/avatar/' . $name;
        }
        return null;
    }

    

    public function mark_default_address(Request $request)
    {
        $id = $request->input('id');
        $address = CustomerAddress::findOrFail($id);

        $address->default = 1;
        $address->save();

        CustomerAddress::where('user_id',$address->user_id)
                ->whereNotIn('id',array($address->id))
                ->update(['default' => '0']);

        
        if ($request->ajax()) {

            $data = [
                'addresses' => view('_partials.frontend.customerAddresses')->render(),
                'message' => 'The address was successfully updated.'
            ];
            return response()->json($data);
        }
        return redirect()->back()->with('message', 'The address was successfully updated.');
    }



    public function delete_address(Request $request)
    {
        $data = $request->all();
        $address = CustomerAddress::findOrFail($data['id']);

        $checkUserAddress = \Auth::user()->addresses()->count();

        if($checkUserAddress > 1){
            $address->delete();
        } else {
            return response('You must have at least one address saved', 422);
        }

        if ($request->ajax()) {
            $data = [
                'addresses' => view('_partials.frontend.customerAddresses')->render(),
                'message' => 'The address was successfully deleted.'
            ];
            return response()->json($data);
        }
        return redirect()->back()->with('message', 'The address was successfully deleted.');
    }

}
