<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class QuestionRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|max:150',
            'category'    => 'required|exists:categories,id',
            'choice_a'    => 'required|max:50',
            'choice_b'    => 'required|max:50',
            'choice_c'    => 'required|max:50',
            'choice_d'    => 'required|max:50',
            'correct'     => 'required|in:a,b,c,d',
        ];
    }
}
