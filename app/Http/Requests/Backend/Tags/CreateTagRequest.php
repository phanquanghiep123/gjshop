<?php namespace App\Http\Requests\Backend\Tags;

use App\Http\Requests\Request;

class CreateTagRequest extends Request
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
			//'author' => 'required',
			'name' => 'required',
			'status' => 'required',
		];
    }

}
