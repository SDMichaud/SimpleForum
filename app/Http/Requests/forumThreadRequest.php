<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class forumThreadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Idea: People IP banned should not be able to post
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
            'subject' => 'required', // For now. Should eventually be changed
            'content' => 'required',
        ];
    }
}
