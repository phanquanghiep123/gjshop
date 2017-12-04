<?php namespace App\Http\Requests\Backend\Competitions;

use App\Http\Requests\Request;

class CreateCompetitionRequest extends Request {

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
            'name'            => 'required',
            'slug'              => 'required',
            'description'              => 'required',
            'status'           => 'required',
        ];
    }

}
