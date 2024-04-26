<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationUpdateRequest extends FormRequest
{
    public function rules()
{
    return [
        'new_date' => 'required|date|after_or_equal:today',
        'new_reservation_time' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) {
                if ($this->input('new_date') === now()->format('Y-m-d') && $value < now()->format('H:i')) {
                    $fail('今の時間より後の時間を選択してください。');
                }
            },
        ],
        'new_number_of_people' => 'required|integer|min:1|max:10',
    ];
}

    public function messages()
    {
        return [
            'new_date.required' => '日付は必須です。',
            'new_date.date' => '有効な日付を入力してください。',
            'new_date.after_or_equal' => '過去の日付は選択できません。',
            'new_reservation_time.required' => '時間は必須です。',
            'new_reservation_time.after_or_equal' => '過去の時間は選択できません。',
            'new_reservation_time.required_if' => '今の時間より後の時間を選択してください。',
            'new_number_of_people.required' => '人数は必須です。',
            'new_number_of_people.integer' => '人数は整数で入力してください。',
            'new_number_of_people.min' => '最低1人以上選択してください。',
            'new_number_of_people.max' => '最大10人まで選択できます。',
        ];
    }
}
