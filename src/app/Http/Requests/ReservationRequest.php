<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\AfterCurrentTime;
use Carbon\Carbon;

class ReservationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => ['required', 'date', 'after_or_equal:today'],
            'reservation_time' => [
                'required',
                'date_format:H:i',
                new AfterCurrentTime($this->date)
            ],
            'number_of_people' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を指定してください。',
            'date.date' => '有効な日付形式を入力してください。',
            'date.after_or_equal' => '過去の日付は指定できません。',
            'reservation_time.required' => '予約時間を指定してください。',
            'reservation_time.date_format' => '有効な時間形式を入力してください。',
            'number_of_people.required' => '人数を指定してください。',
            'number_of_people.integer' => '人数は整数で入力してください。',
            'number_of_people.min' => '少なくとも1人以上の人数を指定してください。',
        ];
    }
}
