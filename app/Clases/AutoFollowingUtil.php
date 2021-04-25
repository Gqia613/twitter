<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class FavoriteUtil
{
	public static function autofollow(string $access, string $secret, string $keyword)
	{
		$TWITTER_API_KEY = 'BU3nJV0t3sQDVJWVEWjeX589p';
		$TWITTER_API_SECRET = 'Z8M7s5sdenckMfKmNigL78CjMBHAedDKm7djQBHamvqLEH3deQ';
		$access_token = $access;
		$access_token_secret = $secret;

        $twitter = new TwitterOAuth($TWITTER_API_KEY, $TWITTER_API_SECRET, $access_token, $access_token_secret);

        $tweets = $twitter->get('search/tweets', ['q' => $keyword, 'count' => 5]);
        
        $tweets = $twitter->get('riends/ids', ['cursor' => $keyword, 'count' => -1]);

        foreach($tweets->statuses as $tweet){
            $result = $twitter->post('friendships/create', ['id' => $tweet->id]);
        };
    }
};