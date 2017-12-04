<?php namespace App\Http\Requests\Backend\Slides;

use App\Http\Requests\Request;

class UpdateSlideRequest extends Request
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
			'image' => 'required',
            'order' => 'required',
            'status' => 'required',
            'caption_position' => 'required_with:caption'
		];
    }

}
