<?php namespace App\Http\Requests\Frontend\Reviews;

use App\Http\Requests\Request;

class AddRecipeReviewRequest extends Request
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
            'name'          => 'required_if:user_id,0',
            'comments'      => 'required',
        ];
    }


    public function messages()
    {
        return [
            'name.required_if'      => 'Please enter your name.',
            'comments.required'     => 'Please enter your comment.',
        ];
    }

}
