<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Clases\TweetUtil;
use App\Clases\SearchUtil;
use App\Clases\FavoriteUtil;
use App\Clases\AutoFallowUtil;
use App\Models\Content;
use App\Models\Token;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index(Request $request)
    {
        // ログインしていなかったら、Login画面を表示
        // if (!Auth::check()) {
        //     return redirect('/login');
        // }

        date_default_timezone_set('Asia/Tokyo');
        $userId = Auth::id();
        $items = Content::where('user_id', $userId)->where('del_flag', 0)->orderBy('reservation_time', 'asc')->get();
        return view('mypage.index', ['items' => $items, 'userId' => $userId]);
    }

    public function add(Request $request)
    {
        $this->validate($request, Content::$rules, Content::$messages);
        $content = new Content;
        $form = $request->all();
        unset($form['_token']);
        $content->fill($form)->save();
        return redirect('/');
    }

    public function tweeted()
    {
        $items = Content::where('del_flag', 1)->orderBy('reservation_time', 'desc')->get();
        return view('mypage.tweeted', ['items' => $items]);  
    }

    public function info()
    {
        return view('mypage.info');
    }

    public function tweet()
    {
        // $userId = 1;
        $userId = Auth::id();
        // $userId = Auth::user()->id;
        $data = Content::where('user_id', $userId)->where('del_flag', 0)->orderBy('reservation_time', 'asc')->first();
        $content = $data['content'];
        $reservation_time = $data['reservation_time'];

        date_default_timezone_set('Asia/Tokyo');
        if(!empty($data)) {
            if(strtotime(date("Y/m/d H:i")) >= strtotime($reservation_time)) {
                $token = Token::select(['access_token', 'access_token_secret'])->where('user_id', $userId)->first();
                $access_token = $token['access_token'];
                $access_token_secret = $token['access_token_secret'];
                // TweetUtil::tweet($token->access_token, $token->access_token_secret, $data->content);
                // TweetUtil::tweet($access_token, $access_token_secret, $content);
                AutoFallowUtil::autotweet($access_token, $access_token_secret, $content);
                
                $content = Content::find($data['id']); 
                $form = ['del_flag' => 1];
                unset($form['_token']);
                $content->fill($form)->save();
            }else {
                return view('mypage.index');
            }
        }else {
            return view('mypage.search');
        }
    }

    public function delete(Request $request)
    {
        $content = Content::find($request->id); 
        $form = ['del_flag' => 2];
        unset($form['_token']);
        $content->fill($form)->save();

        return redirect('/');
    }

    public function search()
    {
        return view('mypage.search');
    }

    public function searchRes(Request $request)
    {
        $tweets = SearchUtil::search($request->keyword);
        return view('mypage.search', ['tweets' => $tweets]);
    }

    public function favorite()
    {
        return view('mypage.favorite');
    }

    public function favoriteRes(Request $request)
    {
        FavoriteUtil::favorite($request->keyword, $request->num);
        
        return redirect('/');
    }

    public function auto()
    {
        return view('mypage.autofallow');
    }

    public function autoRes(Request $request)
    {
		define('TWITTER_API_KEY', 'BU3nJV0t3sQDVJWVEWjeX589p');
		define('TWITTER_API_SECRET', 'Z8M7s5sdenckMfKmNigL78CjMBHAedDKm7djQBHamvqLEH3deQ');
		// define('CALLBACK_URL', 'http://localhost:8000/callback');
		define('CALLBACK_URL', 'https://kairuseki.site/callback');

		//TwitterOAuthのインスタンスを生成し、Twitterからリクエストトークンを取得する
		$twitter_connect = new TwitterOAuth(TWITTER_API_KEY, TWITTER_API_SECRET);
		$request_token = $twitter_connect->oauth('oauth/request_token', ['oauth_callback' => CALLBACK_URL]);
        
		$request->session()->put('oauth_token', $request_token['oauth_token']);
		$request->session()->put('oauth_token_secret', $request_token['oauth_token_secret']);
		
		//Twitterの認証画面へリダイレクト
		$url = $twitter_connect->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		
		return redirect($url);
    }

    public function callback(Request $request)
    {
        define('TWITTER_API_KEY', 'BU3nJV0t3sQDVJWVEWjeX589p');
		define('TWITTER_API_SECRET', 'Z8M7s5sdenckMfKmNigL78CjMBHAedDKm7djQBHamvqLEH3deQ');
        $oauth_token = $request->session()->get('oauth_token');
        $oauth_token_secret = $request->session()->get('oauth_token_secret');
        
        if ($request->has('oauth_token') && $oauth_token !== $request->oauth_token) {
            return redirect('/');
        }

        $twitter = new TwitterOAuth(TWITTER_API_KEY, TWITTER_API_SECRET);

        $token = $twitter->oauth('oauth/access_token', array(
            'oauth_verifier' => $request->oauth_verifier,
            'oauth_token' => $request->oauth_token,
        ));

        $access_token = $token['oauth_token'];
        $access_token_secret = $token['oauth_token_secret'];
        
        $twitter_user = new TwitterOAuth(
            TWITTER_API_KEY,
            TWITTER_API_SECRET,
            $token['oauth_token'],
            $token['oauth_token_secret']
        );
        
        $userId = Auth::user()->id;
        $token = new Token;
        $token->fill(['user_id' => $userId, 'access_token' => $access_token, 'access_token_secret' => $access_token_secret, 'delete_flg' => 0])->save();

        return redirect('/');
    }

    public function autotweet() {
        date_default_timezone_set('Asia/Tokyo');
        $tokens = Token::select(['access_token', 'access_token_secret', 'delete_flg'])->get();
        $comment1 = 
        '
        おはようございます。

今日も一日積み上げがんばりましょうー！

#今日の積み上げ
        ';
        $comment2 = 
        '
        積み上げお疲れ様です。
一休憩入れて午後もがんばりましょう。

#プログラミング
        ';
        $comment3 = 
        '
        本日も一日お疲れ様でした。

#今日の積み上げ
        ';
        $flg1 = 1;
        $flg2 = 1;
        $flg3 = 1;

        if($token->delete_flg == '0') {
            if(date("H:i") == '06:30' && $flg1 == 1) {
                foreach($tokens as $token) {
                    AutoFallowUtil::autotweet($token->access_token, $token->access_token_secret, $comment1);
                    sleep(180);
                }
                $flg1 = 0;
                sleep(180);
                $flg1 = 1;
            }
            
            if(date("H:i") == '12:30' && $flg2 == 1) {
                foreach($tokens as $token) {
                    AutoFallowUtil::autotweet($token->access_token, $token->access_token_secret, $comment2);
                    sleep(180);
                }
                $flg1 = 0;
                sleep(180);
                $flg2 = 1;
            }
            
            if(date("H:i") == '19:30' && $flg3 == 1) {
                foreach($tokens as $token) {
                    AutoFallowUtil::autotweet($token->access_token, $token->access_token_secret, $comment3);
                    sleep(180);
                }
                $flg1 = 0;
                sleep(180);
                $flg1 = 1;
            }
        }
        return view('mypage.debug', ['tokens' => $tokens, 'date' => date("H:i")]);
    }
}
