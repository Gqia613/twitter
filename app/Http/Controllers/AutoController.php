<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Clases\TweetUtil;
use App\Clases\AutoTweetUtil;
use App\Models\Content;
use App\Models\Token;
use Illuminate\Support\Facades\Auth;

class AutoController extends Controller
{
    public function tweet()
    {
        $userId = Auth::id();
        $data = Content::where('user_id', $userId)->where('del_flag', 0)->orderBy('reservation_time', 'asc')->first();
$log = Logger::getInstance();
        date_default_timezone_set('Asia/Tokyo');
        if(!empty($data)) {
            
$log->debug('１通った');
            if(strtotime(date("Y/m/d H:i")) >= strtotime($data['reservation_time'])) {
$log->debug('２通った');
                $token = Token::select(['access_token', 'access_token_secret', 'delete_flg'])->where('user_id', $userId)->first();
                TweetUtil::tweet($token, $data['content']);
                
                $content = Content::find($data['id']);
                $form = ['del_flag' => 1];
                unset($form['_token']);
                $content->fill($form)->save();
            }
        }
    }

    public function autotweet() {
        $tokens = Token::select(['access_token', 'access_token_secret', 'delete_flg'])->get();
        AutoTweetUtil::autoFixedTweet($tokens);
    }

}