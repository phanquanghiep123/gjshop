<?php namespace App\Http\Requests\Backend\Retailers;

use App\Http\Requests\Request;

class CreateRetailerRequest extends Request
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
			'company' => 'required',
            'region' => 'required',
            'country' => 'required',
            'contact_name' => 'required',
            'contact_number' => 'required',
            'position'  => 'required',
            'contact_email' => 'required|email',
            'delivery_address' => 'required',
		];
    }

}
