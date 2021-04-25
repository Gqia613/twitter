<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class AutoFallowUtil
{

	public static function autotweet(string $access, string $secret, string $comment)
	{
		$TWITTER_API_KEY = 'BU3nJV0t3sQDVJWVEWjeX589p';
		$TWITTER_API_SECRET = 'Z8M7s5sdenckMfKmNigL78CjMBHAedDKm7djQBHamvqLEH3deQ';
		$access_token = $access;
		$access_token_secret = $secret;

		$twitter = new TwitterOAuth($TWITTER_API_KEY, $TWITTER_API_SECRET, $access_token, $access_token_secret);
		$result = $twitter->post('statuses/update', array('status' => $comment));
	
	}
}