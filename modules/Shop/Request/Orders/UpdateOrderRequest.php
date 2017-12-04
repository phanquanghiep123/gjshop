<?php

namespace Modules\Shop\Request\Orders;

use Modules\Shop\Request\Request;

/**
 * Description of UpdateProductRequest
 *
 * @author dinhtrong
 */
class UpdateOrderRequest extends Request {
    
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
        'send_update_email' => 'required_if:status,2,5',
        'tracking_ref'      => 'required_if:tracked,1',
        'ship_date'         => 'required_if:status,2',
        'shipping_method_id' => 'required_if:status,2',
            
        ];
    }

    public function messages() {
        return [
            'send_update_email.required_if' => 'Send the customer the order status update email',
            'tracking_ref.required_if'      => 'The tracking number is required',
            'ship_date.required_if'         => 'The ship date is required',
            'shipping_method_id.required_if' => 'The shipping method is required',
        ];
    }
}
