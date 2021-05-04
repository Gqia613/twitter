@extends('layouts.index')

@section('title', 'ツイート検索')

@section('content')
    <div class="row">
        <form class="col s12" action="/search" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="input_text" type="text" name="keyword">
                    <label for="input_text">キーワード</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light deep-purple" type="submit">検索
                <i class="material-icons right">send</i>
            </button>
            <!-- <input type="submit" value="検索"> -->
        </form>
    </div>

    <section>
    @isset($tweets)
        @foreach($tweets->statuses as $tweet)
        <div class="contents">
            <p class="reservation_time">ユーザー名：{{$tweet->user->name}}</p>
            <h3>投稿内容</h3>
            <p class="content">{{$tweet->text}}</p>
        </div>
        @endforeach

    @endisset
    </section>
@endsection