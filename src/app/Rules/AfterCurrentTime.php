<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class AfterCurrentTime implements Rule
{
    public $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function passes($attribute, $value)
    {
        if ($this->date != Carbon::today()->toDateString()) {
            return true;
        }

        return Carbon::createFromFormat('H:i', $value)->gt(Carbon::now());
    }

    public function message()
    {
        return '過去の時間は指定できません。';
    }
}

