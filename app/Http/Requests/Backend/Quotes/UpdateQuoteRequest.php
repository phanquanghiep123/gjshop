<?php namespace App\Http\Requests\Backend\Quotes;

use App\Http\Requests\Request;

class UpdateQuoteRequest extends Request
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
            'quote' => 'required',
            'status' => 'required',
            'category_id' => 'required',
		];
    }

}
