<?php namespace App\Http\Requests\Frontend\Profiles;

use App\Http\Requests\Request;

class UpdateProfileRequest extends Request
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
            'username' => 'unique:users,username,'.\Auth::id(),
            'email' => 'required|email|unique:users,email,'.\Auth::id(),
            'confirm_password' => 'required_with:password|same:password',
            'avatar' => 'image|max:2000'
        ];
    }


    public function messages()
    {
        return [
            'confirm_password.required_with'     => 'Please confirm your password',
        ];
    }

}
