<?php

namespace App\Clases;

use App\Models\Token;

class CooperationCheckUtil
{
    public static function check($userId)
    {
        $tokens = Token::select(['access_token', 'access_token_secret'])->where('user_id', $userId)->where('delete_flg', 0)->first();
        if(empty($tokens)) {
            return view('mypage.autofallow');
        }
    }
};