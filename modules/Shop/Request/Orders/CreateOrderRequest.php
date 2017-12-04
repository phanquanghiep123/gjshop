<?php

namespace Modules\Shop\Request\Orders;

use Modules\Shop\Request\Request;
/**
 * Description of CreateProductRequest
 *
 * @author dinhtrong
 */
class CreateOrderRequest extends Request {
    
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
            'shipping_method'   => 'required|rightShippingMethod',
            'city_state'        => 'required',
            'zip_code'          => 'required',
            'address'           => 'required',
            'country'           => 'required',
            'phone'             => 'required',
        ];
    }

    public function messages() {
        return [
            'shipping_method.rightShippingMethod'   => 'Send the customer the order status update email',
            'city_state.required'                   => 'The city/state is required',
            'zip_code.required'                     => 'The post/zip code is required',
            'address.required'                      => 'The house name/door number and street are required',
            'country.required'                      => 'The country is required',
            'phone.required'                        => 'A phone number is required',
        ];
    }
}
