<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class SearchUtil
{
    public static function search($keyword, $tokens)
    {
        $access_token = $tokens->access_token;
        $access_token_secret = $tokens->access_token_secret;

        $connection = new TwitterOAuth(config('twitter.twitter_api_key'), config('twitter.twitter_api_secret'), $access_token, $access_token_secret);

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