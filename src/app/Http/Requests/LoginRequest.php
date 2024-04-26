<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|string|email|max:191',
            'password' => 'required|string|min:8|max:191',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください。',
            'email.string'=>'メールアドレスを文字列で入力してください。',
            'email.email' => 'メールアドレスをメール形式で入力してください。',
            'email.max' => 'メールアドレスを191文字以内で入力してください。',
            'password.required' => 'パスワードを入力してください。',
            'password.string' => 'パスワードを文字列で入力してください。',
            'password.min' => 'パスワードを8文字以上で入力してください。',
            'password.max' => 'パスワードを191文字以内で入力してください。',
        ];
    }
}

