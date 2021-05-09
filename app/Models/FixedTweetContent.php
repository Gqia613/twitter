<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FixedTweetContent extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'fixed_tweet_flg' => 'required',
        'content1' => 'max:140',
        'content2' => 'max:140',
        'content3' => 'max:140',
    );

    public static $messages = array(
        'fixed_tweet_flg.required' => '投稿かするかしないか選べ！！',
        'content1.max' => '6時30分投稿内容は140字以内で入力してください。',
        'content2.max' => '12時30分投稿内容は140字以内で入力してください。',
        'content3.max' => '19時30分投稿内容は140字以内で入力してください。',
    );
}
