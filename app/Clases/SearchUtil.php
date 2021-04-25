<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class SearchUtil
{
    public static function search($keyword)
    {
        $consumer_key = 'BU3nJV0t3sQDVJWVEWjeX589p';
        $consumer_key_sercret = 'Z8M7s5sdenckMfKmNigL78CjMBHAedDKm7djQBHamvqLEH3deQ';
        $access_token = '3847413613-OX7PRl3lsP6sBldYG9juAwlaVT4ZmnruIz34mFp';
        $access_token_secret = 'N6qIcYz0KGkCNS4KBzAb6otC6pQxq6JOl5rK0jnP7TjEZ';

        $connection = new TwitterOAuth($consumer_key, $consumer_key_sercret, $access_token, $access_token_secret);

        $tweets = $connection->get('search/tweets', ['q' => $keyword, 'count' => '10']);
        return $tweets;
        // foreach($tweets->statuses as $tweet){
        //   echo '<p>';
        //   echo 'ステータスID: ' . $tweet->id . '<br>';
        //   echo '名前: ' . $tweet->user->name . '<br>';
        //   echo 'ユーザー名(screen_name): ' . $tweet->user->screen_name . '<br>';
        //   echo 'ツイート本文: ' . $tweet->text . '<br>';
        //   echo '作成日: ' . date('Y-m-d H:i:s', strtotime($tweet->created_at)) . '<br>';
        //   echo 'ツイート: ' . $tweet->source . '<br>';
        //   echo 'リツイート数: ' . $tweet->retweet_count . '<br>';
        //   echo 'いいね数: ' . $tweet->favorite_count;
        //   echo '</p>';
        // }
    }
};



?>