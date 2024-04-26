<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
            'admin_name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:admins',
            'password' => 'required|string|min:8|max:191',
        ];
    }

    public function messages()
    {
        return [
            'admin_name.required' => '名前を入力してください。',
            'admin_name.string' => '名前は文字列で入力してください。',
            'admin_name.max' => '名前は191文字以内で入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.string' => 'メールアドレスは文字列で入力してください。',
            'email.email' => '有効なメールアドレス形式で入力してください。',
            'email.max' => 'メールアドレスは191文字以内で入力してください。',
            'email.unique' => 'そのメールアドレスはすでに使用されています。',
            'password.required' => 'パスワードを入力してください。',
            'password.string' => 'パスワードは文字列で入力してください。',
            'password.min' => 'パスワードは少なくとも8文字以上で入力してください。',
            'password.max' => 'パスワードは191文字以内で入力してください。',
        ];
    }
}

