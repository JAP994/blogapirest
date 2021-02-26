<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'tittle' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'url' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tittle.required' => 'Please fill the tittle.',
            'summary.required' => 'Please fill the summary.',
            'content.required' => 'Please fill the content.',
            'url.required' => 'Please fill the url.',
            'user_id.required' => 'Please fill the user_id.',
            'category_id.required' => 'Please fill the category_id.',
        ];
    }

}