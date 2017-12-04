<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\Request;

/**
 * Description of EnroleCourseRequest
 *
 * @author dinhtrong
 */
class ContactUs extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' 			=> 'required',
            'email' 		=> 'required|email',
            'department' 	=> 'required',
            'message' 		=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' 		=> 'Please enter your name.',
            'email.required' 		=> 'Please enter your email.',
            'department.required' 	=> 'Please select a department.',
            'message.required' 		=> 'Please enter your message.'
        ];
    }

}
