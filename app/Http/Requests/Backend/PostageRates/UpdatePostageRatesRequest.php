<?php namespace App\Http\Requests\Backend\PostageRates;

use App\Http\Requests\Request;

class UpdatePostageRatesRequest extends Request
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
            'courier_id' => 'required',
            'name' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'min_weight' => 'required',
            'max_weight' => 'required',
            'size' => 'required',
            'fee' => 'required',
            'service' => 'required',
            'status' => 'required',

		];
    }

    public function messages()
    {
        return [
            'courier_id.required' => 'The courier is required',
        ];
    }

}
