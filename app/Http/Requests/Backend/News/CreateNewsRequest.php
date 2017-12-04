<?php namespace App\Http\Requests\Backend\News;

use App\Http\Requests\Request;

class CreateNewsRequest extends Request
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
			'title' => 'required',
            'list_image' => 'required',
            'description' => 'required',
            'content' => 'required',
            'post_date' => 'date',
            'status' => 'required',
		];
    }

}