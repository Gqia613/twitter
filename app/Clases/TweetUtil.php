<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class TweetUtil
{
    public static function tweet($token, $comment)
    {
        $access_token = $token->access_token;
        $access_token_secret = $token->access_token_secret;

		$twitter = new TwitterOAuth(config('twitter.twitter_api_key'), config('twitter.twitter_api_secret'), $access_token, $access_token_secret);
		$result = $twitter->post('statuses/update', array('status' => $comment));
    }
};



?>