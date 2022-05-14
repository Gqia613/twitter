<?php

namespace App\Services;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class FavoriteService
{
    public static function favorite($keyword, $num, $tokens)
    {
        $access_token = $tokens->access_token;
        $access_token_secret = $tokens->access_token_secret;

        $connection = new TwitterOAuth(config('twitter.twitter_api_key'), config('twitter.twitter_api_secret'), $access_token, $access_token_secret);

        $tweets = $connection->get('search/tweets', ['q' => $keyword, 'count' => $num]);
        
        foreach($tweets->statuses as $tweet){
            $result = $connection->post('favorites/create', ['id' => $tweet->id]);
        };
    }
};

?>