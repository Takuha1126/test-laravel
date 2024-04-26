<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopRepresentativeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'shop_id' => 'required|unique:shop_representatives,shop_id',
            'representative_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:shop_representatives,email',
            'password' => 'required|string|min:8|max:191',
        ];
    }

    public function messages()
    {
        return [
            'shop_id.required' => '店舗名は必須です。',
            'shop_id.unique' => '同じ店舗の代表者は既に存在します。',
            'representative_name.required' => '名前は必須です。',
            'representative_name.string' => '名前は文字列で入力してください。',
            'representative_name.max' => '名前は255文字以内で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.string' => 'メールアドレスは文字列で入力してください。',
            'email.email' => '有効なメールアドレス形式で入力してください。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'email.unique' => 'そのメールアドレスはすでに使用されています。',
            'password.required' => 'パスワードは必須です。',
            'password.string' => 'パスワードは文字列で入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは255文字以内で入力してください。',
        ];
    }
}

