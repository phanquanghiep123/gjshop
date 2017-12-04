<?php namespace App\Http\Requests\Backend\EmailTemplates;

use App\Http\Requests\Request;

class CreateEmailTemplateRequest extends Request
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
			'name' => 'required|unique:email_templates,name',
            'subject' => 'required',
            'email' => 'required',
		];
    }

}