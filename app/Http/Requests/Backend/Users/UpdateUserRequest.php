<?php namespace App\Http\Requests\Backend\Users;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
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
			'confirm_password' => 'required_with:password|same:password',
		];
    }

}
