<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class FavoriteUtil
{
	public static function autofollow(string $access, string $secret, string $keyword)
	{
		$access_token = $access;
		$access_token_secret = $secret;

        $twitter = new TwitterOAuth(config('twitter.twitter_api_key'), config('twitter.twitter_api_secret'), $access_token, $access_token_secret);

        $tweets = $twitter->get('search/tweets', ['q' => $keyword, 'count' => 5]);
        
        $tweets = $twitter->get('riends/ids', ['cursor' => $keyword, 'count' => -1]);

        foreach($tweets->statuses as $tweet){
            $result = $twitter->post('friendships/create', ['id' => $tweet->id]);
        };
    }
};