<?php

namespace Modules\Shop\Request\Vouchers;

use Modules\Shop\Request\Request;

/**
 * Description of CreateProductRequest
 *
 * @author dinhtrong
 */
class CreateVoucherRequest extends Request {
     public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'voucher_amount'      => 'required',
        ];
    }

    public function messages()
    {
        return [
            'voucher_amount.required'     => 'Please select a voucher amout',
        ];
    }

   
        
    
}
