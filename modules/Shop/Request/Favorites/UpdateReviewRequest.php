<?php

namespace Modules\Shop\Request\Reviews;

use Modules\Shop\Request\Request;

/**
 * Description of UpdateProductRequest
 *
 * @author dinhtrong
 */
class UpdateReviewRequest extends Request {
    
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
            
        ];
    }
}
