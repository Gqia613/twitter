<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Clases\TweetUtil;
use App\Clases\SearchUtil;
use App\Clases\FavoriteUtil;
use App\Clases\AutoFallowUtil;
use App\Clases\AutoTweetUtil;
use App\Clases\CooperationCheckUtil;
use App\Models\Content;
use App\Models\Token;
use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MypageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $checkToken = CooperationCheckUtil::check(Auth::id());        
        if(empty($checkToken)) {
            return redirect('/autofallow');
        }
        date_default_timezone_set('Asia/Tokyo');
        $userId = Auth::id();
        $items = Content::where('user_id', $userId)->where('del_flag', 0)->orderBy('reservation_time', 'asc')->get();
        $token = Token::where('user_id', $userId)->where('delete_flg', 0)->first();
        return view('mypage.index', ['items' => $items, 'userId' => $userId, 'token' => $token]);
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
        $checkToken = CooperationCheckUtil::check(Auth::id());        
        if(empty($checkToken)) {
            return redirect('/autofallow');
        }
        $userId = Auth::id();
        $items = Content::where('user_id', $userId)->where('del_flag', 1)->orderBy('reservation_time', 'desc')->get();
        return view('mypage.tweeted', ['items' => $items]);  
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
        $checkToken = CooperationCheckUtil::check(Auth::id());        
        if(empty($checkToken)) {
            return redirect('/autofallow');
        }
        return view('mypage.search');
    }

    public function searchRes(Request $request)
    {
        $rules = [
            'keyword' => 'required',
        ];

        $message = [
            'keyword.required' => 'キーワードを入力して下さい。',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect('/search')
            ->withErrors($validator)
            ->withInput();
        } else {            
            $userId = Auth::id();
            $tokens = Token::select(['access_token', 'access_token_secret', 'delete_flg'])->where('user_id', $userId)->first();
            $tweets = SearchUtil::search($request->keyword, $tokens);
            return view('mypage.search', ['tweets' => $tweets]);
        }
    }

    public function favorite()
    {
        $checkToken = CooperationCheckUtil::check(Auth::id());        
        if(empty($checkToken)) {
            return redirect('/autofallow');
        }
        return view('mypage.favorite');
    }

    public function favoriteRes(Request $request)
    {
        $rules = [
            'keyword' => 'required',
            'num' => 'required',
        ];

        $message = [
            'keyword.required' => 'キーワードを入力して下さい。',
            'num.required' => 'ツイート数を入力して下さい。',
        ];

        $validator = Validator::make($request->all(), $rules, $message);

        if ($validator->fails()) {
            return redirect('/favorite')
            ->withErrors($validator)
            ->withInput();
        } else {  
            $userId = Auth::id();
            $tokens = Token::select(['access_token', 'access_token_secret', 'delete_flg'])->where('user_id', $userId)->first();
            FavoriteUtil::favorite($request->keyword, $request->num, $tokens);
            
            return view('mypage.favorite');
        }
    }

    public function auto()
    {
        return view('mypage.autofallow');
    }

    public function autoRes(Request $request)
    {
		//TwitterOAuthのインスタンスを生成し、Twitterからリクエストトークンを取得する
		$twitter_connect = new TwitterOAuth(config('twitter.twitter_api_key'), config('twitter.twitter_api_secret'));
		$request_token = $twitter_connect->oauth('oauth/request_token', ['oauth_callback' => config('twitter.callback_url')]);
        
		$request->session()->put('oauth_token', $request_token['oauth_token']);
		$request->session()->put('oauth_token_secret', $request_token['oauth_token_secret']);
		
		//Twitterの認証画面へリダイレクト
		$url = $twitter_connect->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
		
		return redirect($url);
    }

    public function callback(Request $request)
    {
        $oauth_token = $request->session()->get('oauth_token');
        $oauth_token_secret = $request->session()->get('oauth_token_secret');
        
        if ($request->has('oauth_token') && $oauth_token !== $request->oauth_token) {
            return redirect('/');
        }

        $twitter = new TwitterOAuth(config('twitter.twitter_api_key'), config('twitter.twitter_api_secret'));

        // 「連携アプリを認証」をクリックして帰ってきた時
        if(isset( $_GET["oauth_token"]) && isset($_GET["oauth_verifier"])) {
            $token = $twitter->oauth('oauth/access_token', array(
                'oauth_verifier' => $request->oauth_verifier,
                'oauth_token' => $request->oauth_token,
            ));
            $access_token = $token['oauth_token'];
            $access_token_secret = $token['oauth_token_secret'];

            $userId = Auth::user()->id;
            $token = new Token;
            $token->fill(['user_id' => $userId, 'access_token' => $access_token, 'access_token_secret' => $access_token_secret, 'delete_flg' => 0])->save();

            return redirect('/');
        // 「キャンセル」をクリックして帰ってきた時
        } elseif (isset($_GET["denied"])) {
            return redirect('/');
        }
    }
}
