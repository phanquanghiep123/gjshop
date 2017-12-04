<?php

namespace App\Http\Requests\Frontend\Referrals;

use App\Http\Requests\Request;

/**
 * Description of EnroleCourseRequest
 *
 * @author dinhtrong
 */
class AddReferralRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'f_name' 			=> 'required',
            'l_name'            => 'required',
            'email' 		    => 'required|unique:users,email',
            'mobile'            => 'unique:users,mobile',
        ];
    }

    public function messages()
    {
        return [
            'f_name.required' 		=> 'Please enter your referral\'s first name.',
            'l_name.required'       => 'Please enter your referral\'s last name.',
            'email.required' 		=> 'Please enter your referral\'s email.',
            'email.unique' 	        => 'The referral\'s email is already registered in our system, please try another candidate.',
            'mobile.unique'         => 'The referral\'s mobile is already registered in our system, please try another candidate.',
        ];
    }

}
