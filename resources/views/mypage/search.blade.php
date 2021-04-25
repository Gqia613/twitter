@extends('layouts.index')

@section('title', 'ツイート検索')

@section('menu')
    <a href="/">マイページに戻る</a>
@endsection

@section('content')
    <form action="/search" method="post">
        @csrf
        <input type="text" name="keyword">
        <input type="submit" value="検索">
    </form>



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