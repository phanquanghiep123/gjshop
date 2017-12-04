<?php

namespace Modules\Shop\Request\Subscriptions;

use Modules\Shop\Request\Request;

class SubscribeStockDeliveredRequest extends Request {

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
            'email' => 'required|email'
        ];
    }

}
