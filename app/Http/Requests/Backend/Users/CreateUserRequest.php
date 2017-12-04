<?php namespace App\Http\Requests\Backend\Users;

use App\Http\Requests\Request;

class CreateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
			'f_name' => 'required',
			'l_name' => 'required',
			'username' => 'required',
			'gender' => 'required',
			'email' => 'required',
            'roles'     => 'required',
			'password' => 'required',
            'confirm_password' => 'same:password',

		];
    }


    public function messages()
    {
        return [
            'f_name.required' => 'The user\'s first name is required',
            'l_name.required' => 'The user\'s last name is required',
            'roles.required'     => 'The users role is required',
        ];
    }

}
