<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'shop_id' => 'required',
            'password' => 'required|string|min:8|max:191',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => '店舗名は必須です。',
            'password.required' => 'パスワードを入力してください。',
            'password.string' => 'パスワードを文字列で入力してください。',
            'password.min' => 'パスワードを8文字以上で入力してください。',
            'password.max' => 'パスワードを191文字以内で入力してください。',
        ];
    }
}
