<?php

namespace Modules\Shop\Request\Favorites;

use Modules\Shop\Request\Request;

/**
 * Description of CreateProductRequest
 *
 * @author dinhtrong
 */
class DeleteFavoriteRequest extends Request {
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
