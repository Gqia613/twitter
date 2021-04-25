<?php

namespace App\Clases;

use App\Models\Content;
use Abraham\TwitterOAuth\TwitterOAuth;

class TweetUtil
{
    public static function tweet(string $access = null, string $secret = null, string $comment = null)
    {
        $TWITTER_API_KEY = 'BU3nJV0t3sQDVJWVEWjeX589p';
		$TWITTER_API_SECRET = 'Z8M7s5sdenckMfKmNigL78CjMBHAedDKm7djQBHamvqLEH3deQ';
		$access_token = $access;
		$access_token_secret = $secret;

		$twitter = new TwitterOAuth($TWITTER_API_KEY, $TWITTER_API_SECRET, $access_token, $access_token_secret);
		$result = $twitter->post('statuses/update', array('status' => $comment));
        // $data = Content::where('del_flag', 0)->orderBy('reservation_time', 'asc')->first();
        // $reservation_time = $data['reservation_time'];

        // date_default_timezone_set('Asia/Tokyo');
        // if(strtotime(date("Y/m/d H:i")) >= strtotime($reservation_time))
        // {
        //     $content = $data['content'];
        //     // $media_id = $toa->upload("media/upload", array("media" => "画像ファイルパス"));

        //     // //投稿設定
        //     // $parameters = array(
        //     //     'status' => $postMsg,
        //     //     'media_ids' => $media_id->media_id_string,
        //     // );
        //     /**************************************************

        //     POSTメソッドのリクエスト [アクセストークン]

        //     **************************************************/

        //     // 設定
        //     $api_key = 'BU3nJV0t3sQDVJWVEWjeX589p';		// APIキー
        //     $api_secret = 'Z8M7s5sdenckMfKmNigL78CjMBHAedDKm7djQBHamvqLEH3deQ';		// APIシークレット
        //     $access_token = '3847413613-OX7PRl3lsP6sBldYG9juAwlaVT4ZmnruIz34mFp';		// アクセストークン
        //     $access_token_secret = 'N6qIcYz0KGkCNS4KBzAb6otC6pQxq6JOl5rK0jnP7TjEZ';		// アクセストークンシークレット[_TWITTER_OAUTH_1_]
        //     $request_url = 'https://api.twitter.com/1.1/statuses/update.json';		// エンドポイント
        //     $request_method = 'POST';

        //     // パラメータA (リクエストのオプション)
        //     $params_a = array(
        //     'status' => $content ,
        //     //	'media_ids' => "" ,	// 添付する画像のメディアID
        //     ) ;

        //     // キーを作成する (URLエンコードする)
        //     $signature_key = rawurlencode( $api_secret ) . '&' . rawurlencode( $access_token_secret ) ;

        //     // パラメータB (署名の材料用)
        //     $params_b = array(
        //     'oauth_token' => $access_token ,
        //     'oauth_consumer_key' => $api_key ,
        //     'oauth_signature_method' => 'HMAC-SHA1' ,
        //     'oauth_timestamp' => time() ,
        //     'oauth_nonce' => microtime() ,
        //     'oauth_version' => '1.0' ,
        //     ) ;

        //     // パラメータAとパラメータBを合成してパラメータCを作る
        //     $params_c = array_merge( $params_a , $params_b ) ;

        //     // 連想配列をアルファベット順に並び替える
        //     ksort( $params_c ) ;

        //     // パラメータの連想配列を[キー=値&キー=値...]の文字列に変換する
        //     $request_params = http_build_query( $params_c , '' , '&' ) ;

        //     // 一部の文字列をフォロー
        //     $request_params = str_replace( array( '+' , '%7E' ) , array( '%20' , '~' ) , $request_params ) ;

        //     // 変換した文字列をURLエンコードする
        //     $request_params = rawurlencode( $request_params ) ;

        //     // リクエストメソッドをURLエンコードする
        //     // ここでは、URL末尾の[?]以下は付けないこと
        //     $encoded_request_method = rawurlencode( $request_method ) ;

        //     // リクエストURLをURLエンコードする
        //     $encoded_request_url = rawurlencode( $request_url ) ;

        //     // リクエストメソッド、リクエストURL、パラメータを[&]で繋ぐ
        //     $signature_data = $encoded_request_method . '&' . $encoded_request_url . '&' . $request_params ;

        //     // キー[$signature_key]とデータ[$signature_data]を利用して、HMAC-SHA1方式のハッシュ値に変換する
        //     $hash = hash_hmac( 'sha1' , $signature_data , $signature_key , TRUE ) ;

        //     // base64エンコードして、署名[$signature]が完成する
        //     $signature = base64_encode( $hash ) ;

        //     // パラメータの連想配列、[$params]に、作成した署名を加える
        //     $params_c['oauth_signature'] = $signature ;

        //     // パラメータの連想配列を[キー=値,キー=値,...]の文字列に変換する
        //     $header_params = http_build_query( $params_c , '' , ',' ) ;

        //     // リクエスト用のコンテキスト
        //     $context = array(
        //     'http' => array(
        //         'method' => $request_method , // リクエストメソッド
        //         'header' => array(			  // ヘッダー
        //             'Authorization: OAuth ' . $header_params ,
        //         ) ,
        //     ) ,
        //     ) ;

        //     // オプションがある場合、コンテキストにPOSTフィールドを作成する
        //     if ( $params_a ) {
        //     $context['http']['content'] = http_build_query( $params_a ) ;
        //     }

        //     // cURLを使ってリクエスト
        //     $curl = curl_init() ;
        //     curl_setopt( $curl, CURLOPT_URL , $request_url ) ;	// リクエストURL
        //     curl_setopt( $curl, CURLOPT_HEADER, true ) ;	// ヘッダーを取得
        //     curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, $context['http']['method'] ) ;	// メソッド
        //     curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false ) ;	// 証明書の検証を行わない
        //     curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true ) ;	// curl_execの結果を文字列で返す
        //     curl_setopt( $curl, CURLOPT_HTTPHEADER, $context['http']['header'] ) ;	// ヘッダー
        //     if( isset( $context['http']['content'] ) && !empty( $context['http']['content'] ) ) {
        //     curl_setopt( $curl, CURLOPT_POSTFIELDS, $context['http']['content'] ) ;	// リクエストボディ
        //     }
        //     curl_setopt( $curl, CURLOPT_TIMEOUT, 5 ) ;	// タイムアウトの秒数
        //     $res1 = curl_exec( $curl ) ;
        //     $res2 = curl_getinfo( $curl ) ;
        //     curl_close( $curl ) ;

        //     $content = Content::find($data['id']); 
        //     $form = ['del_flag' => 1];
        //     unset($form['_token']);
        //     $content->fill($form)->save();
        // }

    }
};



?>