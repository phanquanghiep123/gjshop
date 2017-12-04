<?php namespace App\Http\Requests\Frontend\Articles;

use App\Http\Requests\Request;

class UpdateArticleRequest extends Request
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
            'revised_title' => 'required',
            'revised_content' => 'required',
        ];
    }


    public function messages()
    {
        return [
            'revised_title.required'    => 'Please enter the article title .',
            'revised_content.required'  => 'Please enter the article content.',
        ];
    }

}
