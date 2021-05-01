<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class AutoFallowUtil
{

	public static function autotweet(string $access, string $secret, string $comment)
	{
		$access_token = $access;
		$access_token_secret = $secret;

		$twitter = new TwitterOAuth(config('twitter.twitter_api_key'), config('twitter.twitter_api_secret'), $access_token, $access_token_secret);
		$result = $twitter->post('statuses/update', array('status' => $comment));
	
	}
}