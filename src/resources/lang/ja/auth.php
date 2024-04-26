<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => '認証情報が記録と一致しません。',
    'password' => '提供されたパスワードが正しくありません。',
    'throttle' => 'ログイン試行が多すぎます。:seconds 秒後に再試行してください。',
    'accepted'  => ':attributeを承認してください。',
    'active_url' => ':attributeは有効なURLではありません。',
    'after' => ':attributeは:dateより後の日付である必要があります。',
    'email' => ':attributeを正しいメールアドレス形式で入力してください。',
    'exists' => '選択された:attributeは無効です。',
    'file' => ':attributeはファイルでなければなりません。',
    'max' => [
        'numeric' => ':attributeは:max以下でなければなりません。',
        'file'    => ':attributeは:maxキロバイト以下でなければなりません。',
        'string'  => ':attributeは:max文字以下でなければなりません。',
        'array'   => ':attributeは:max個以下のアイテムを含んでいなければなりません。',
    ],
    'min' => [
        'numeric' => ':attributeは:min以上でなければなりません。',
        'file'    => ':attributeは:minキロバイト以上でなければなりません。',
        'string'  => ':attributeは:min文字以上でなければなりません。',
        'array'   => ':attributeは:min個以上のアイテムを含んでいなければなりません。',
    ],
];
