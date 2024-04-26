<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'photo_url' => 'required',
            'shop_name' => 'required|string|max:191',
            'area_id' => 'required',
            'genre_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'photo_url.required' => '写真を選択してください。',
            'shop_name.required' => '店舗名は必須です。',
            'shop_name.string' => '店舗名は文字列で入力してください。',
            'shop_name.max' => '店舗名は255文字以内で入力してください。',
            'area_id.required' => 'エリア名は必須です。',
            'genre_id.required' => 'ジャンル名は必須です。',
        ];
    }
}
