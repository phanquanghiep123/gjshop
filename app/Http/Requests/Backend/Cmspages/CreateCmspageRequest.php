<?php namespace App\Http\Requests\Backend\Cmspages;

use App\Http\Requests\Request;

class CreateCmspageRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'title'            => 'required',
            //'meta_keywords'    => 'required',
            //'meta_description' => 'required',
            //'list_image'       => 'required|mimes:jpeg,bmp,png|max:32000',
            //'user_id'          => 'required',
            //'description'      => 'required',
            'content'          => 'required',
            'status'           => 'required',
        ];
    }

}
