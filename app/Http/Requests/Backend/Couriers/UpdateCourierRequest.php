<?php namespace App\Http\Requests\Backend\Couriers;

use App\Http\Requests\Request;

class UpdateCourierRequest extends Request
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
            'name' => 'required',
            //'slug' => 'required',
            'brand_logo' => 'required',
            'description' => 'required',
            'status' => 'required',
		];
    }

}
