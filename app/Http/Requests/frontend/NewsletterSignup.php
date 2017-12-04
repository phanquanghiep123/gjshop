<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

/**
 * Description of EnroleCourseRequest
 *
 * @author dinhtrong
 */
class NewsletterSignup extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'signup_name' 	=> 'required',
            'signup_email' 	=> 'required|email'
        ];
    }

     public function messages()
    {
        return [
            'signup_name.required' 	=> 'Please enter your name.',
            'signup_email.required' => 'Please enter your email.',
            'signup_email.email'    => 'Please enter a valid email.'
        ];
    }

}
