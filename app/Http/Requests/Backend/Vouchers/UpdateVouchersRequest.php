<?php namespace App\Http\Requests\Backend\Vouchers;

use App\Http\Requests\Request;

class UpdateVouchersRequest extends Request
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
            'code' => 'required',
            'multiple_use' => 'required',
            'discount_amount' => 'required',
            'discount_type' => 'required',
            'status' => 'required',
            'multiple_use' => 'required',
            'valid_until' => 'required_with:valid_from',
            'valid_from' => 'required_with:valid_until',
            'assigned_to_user' => 'required_if:voucher_type,2',
        ];
    }


    public function messages()
    {
        return [
            'assigned_to_user.required_if' => 'You must select a customer to receive the Loyalty voucher',
            'multiple_use.required' => 'The voucher usage is required',
        ];
    }

}
