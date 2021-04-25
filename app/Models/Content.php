<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

    protected $guarded = array('id');

    public static $rules = array(
        'del_flag' => 'required',
        'reservation_time' => 'required',
        'content' => 'required|max:200',
    );

    public static $messages = array(
        'del_flag.required' => 'フラグは必須です。',
        'reservation_time.required' => '日付は必須です。',
        'content.required' => '投稿内容は必須です。',
        'content.max' => '投稿内容は200字以内で入力してください。',
    );
}
