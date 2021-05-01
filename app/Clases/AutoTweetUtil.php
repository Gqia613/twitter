<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class AutoTweetUtil
{

	public static function autoFixedTweet(array $tokens)
	{
        date_default_timezone_set('Asia/Tokyo');

        $comment1 = 
        '
        おはようございます。

今日も一日積み上げがんばりましょうー！

#今日の積み上げ
        ';
        $comment2 = 
        '
        積み上げお疲れ様です。
一休憩入れて午後もがんばりましょう。

#プログラミング
        ';
        $comment3 = 
        '
        本日も一日お疲れ様でした。

#今日の積み上げ
        ';
        $flg1 = 1;
        $flg2 = 1;
        $flg3 = 1;

        if(date("H:i") == '06:30' && $flg1 == 1) {
            foreach($tokens as $token) {
                if($token->delete_flg == '0') {
                    AutoFallowUtil::autotweet($token->access_token, $token->access_token_secret, $comment1);
                    sleep(180);
                }
            }
            $flg1 = 0;
            sleep(180);
            $flg1 = 1;

        }
        if(date("H:i") == '12:30' && $flg2 == 1) {
            foreach($tokens as $token) {
                if($token->delete_flg == '0') {
                    AutoFallowUtil::autotweet($token->access_token, $token->access_token_secret, $comment2);
                    sleep(180);
                }
            }
            $flg1 = 0;
            sleep(180);
            $flg2 = 1;

        }
        if(date("H:i") == '19:30' && $flg3 == 1) {
            foreach($tokens as $token) {
                if($token->delete_flg == '0') {
                    AutoFallowUtil::autotweet($token->access_token, $token->access_token_secret, $comment3);
                    sleep(180);
                }
            }
            $flg1 = 0;
            sleep(180);
            $flg1 = 1;
        }
	
	}
}