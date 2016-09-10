<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class ArticleRequest extends Request
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
            'title'    => 'required|max:100',
            'category' => 'required|exists:categories,id',
            'content'  => 'required|min:100|max:3000',
            // 'g-recaptcha-response' => 'required|captcha',
        ];
    }
}
