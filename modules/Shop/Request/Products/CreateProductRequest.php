<?php

namespace Modules\Shop\Request\Products;

use Modules\Shop\Request\Request;
/**
 * Description of CreateProductRequest
 *
 * @author dinhtrong
 */
class CreateProductRequest extends Request {
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
            'name' => 'required',
            'ean' => 'required',
            'inventory' => 'required',
            'weight' => 'required',
            'dimentions' => 'required',
            'category' => 'required',
            'gbp_regular_price' => 'required',
            'list_image'    => 'required'

        ];
    }

    public function messages() {
        return [
            'inventory.required' => 'The stock count is required',
            'gbp_regular_price.required' => 'The £ price is required',

        ];
    }
}
