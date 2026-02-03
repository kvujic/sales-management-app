<?php

return [
    'required' => ':attributeを入力してください。',
    'string' => ':attributeは文字列で入力してください。',
    'email' => '有効な:attributeを入力してください。',
    'min' => [
        'string' => ':attributeは:min文字以上で入力してください。'
    ],
    'max' => [
        'string' => ':attributeは:max文字以内で入力してください。'
    ],
    'unique' => ':attributeはすでに使用されています。',
    'same' => ':attributeが一致しません。',

    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'password_confirmation' => 'パスワード（確認）',
    ],
];