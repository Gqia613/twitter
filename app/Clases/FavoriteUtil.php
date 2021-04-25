<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class FavoriteUtil
{
    public static function favorite($keyword, $num)
    {
        $consumer_key = 'BU3nJV0t3sQDVJWVEWjeX589p';
        $consumer_key_sercret = 'Z8M7s5sdenckMfKmNigL78CjMBHAedDKm7djQBHamvqLEH3deQ';
        $access_token = '3847413613-OX7PRl3lsP6sBldYG9juAwlaVT4ZmnruIz34mFp';
        $access_token_secret = 'N6qIcYz0KGkCNS4KBzAb6otC6pQxq6JOl5rK0jnP7TjEZ';

        $connection = new TwitterOAuth($consumer_key, $consumer_key_sercret, $access_token, $access_token_secret);

        $tweets = $connection->get('search/tweets', ['q' => $keyword, 'count' => $num]);
        
        foreach($tweets->statuses as $tweet){
            $result = $connection->post('favorites/create', ['id' => $tweet->id]);
        };
    }
};
