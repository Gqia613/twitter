<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Clases\TweetUtil;
use App\Clases\AutoTweetUtil;
use App\Models\Content;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AutoController extends Controller
{
    public function tweet()
    {
        $userId = Auth::id();
        $datum = Content::where('del_flag', 0)->orderBy('reservation_time', 'asc')->get();
        date_default_timezone_set('Asia/Tokyo');
Log::debug('0通った');
        if(!empty($data)) {
Log::debug('1通った');
            foreach($datum as $data) {
                if(strtotime(date("Y/m/d H:i")) >= strtotime($data['reservation_time'])) {
Log::debug('2通った');
                    $token = Token::select(['access_token', 'access_token_secret'])->where('user_id', $data['user_id'])->first();
                    TweetUtil::tweet($token, $data['content']);
                    
                    $content = Content::find($data['id']);
                    $form = ['del_flag' => 1];
                    unset($form['_token']);
                    $content->fill($form)->save();
                }
            }
        }
    }

    public function autotweet() {
        $tokens = Token::select(['access_token', 'access_token_secret', 'delete_flg'])->get();
        AutoTweetUtil::autoFixedTweet($tokens);
    }

}