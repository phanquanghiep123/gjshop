<?php namespace App\Http\Requests\Frontend\Profiles;

use App\Http\Requests\Request;

class CreateAccountRequest extends Request
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
            'email_address' => 'required|unique:users,email',
            'confirm_password' => 'required_with:register_password|same:register_password',
            'avatar' => 'image|max:2000'
        ];
    }


    public function messages()
    {
        return [
            'f_name.required' => 'Please enter your first name.',
            'l_name.required' => 'Please enter your last name',
            'confirm_password.required_with'     => 'Please confirm your password',
        ];
    }

}
