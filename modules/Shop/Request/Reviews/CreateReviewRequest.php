<?php

namespace Modules\Shop\Request\Reviews;

use Modules\Shop\Request\Request;

/**
 * Description of CreateProductRequest
 *
 * @author dinhtrong
 */
class CreateReviewRequest extends Request {
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
            'name'      => 'required',
            'email'     => 'required',
            'rating'    => 'not_in:0',
            'comment'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'rating.not_in'     => 'Please select the product rating',
            'comment.required'  => 'Please enter your comment',
        ];
    }

   
        
    
}
