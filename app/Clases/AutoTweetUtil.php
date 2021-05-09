<?php

namespace App\Clases;

use App\Models\FixedTweetContent;
use App\Models\Token;
use Abraham\TwitterOAuth\TwitterOAuth;
use App\Clases\TweetUtil;
use Illuminate\Support\Facades\Log;

class AutoTweetUtil
{

	public static function autoFixedTweet()
	{
        date_default_timezone_set('Asia/Tokyo');

        switch (date("H:i")) {
            case '06:30':
                $fixedContents = FixedTweetContent::where('fixed_tweet_flg', 0)->get();
                foreach($fixedContents as $content) {
                    $token = Token::where('delete_flg', 0)->where('user_id', $content->user_id)->first();
                    if($token->delete_flg == '0') {
                        Log::debug('test');
                        TweetUtil::tweet($token, $content->content1);
                    }
                }
                break;
            case '12:30':
                $fixedContents = FixedTweetContent::where('fixed_tweet_flg', 0)->get();
                foreach($fixedContents as $content) {
                    $token = Token::where('delete_flg', 0)->where('user_id', $content->user_id)->first();
                    if($token->delete_flg == '0') {
                        Log::debug('test');
                        TweetUtil::tweet($token, $content->content2);
                    }
                }
                break;
            case '18:53':
                $fixedContents = FixedTweetContent::where('fixed_tweet_flg', 0)->get();
                foreach($fixedContents as $content) {
                    $token = Token::where('delete_flg', 0)->where('user_id', $content->user_id)->first();
                    if($token->delete_flg == '0') {
                        Log::debug('test');
                        TweetUtil::tweet($token, $content->content3);
                    }
                }
                break;
        }
	}
}