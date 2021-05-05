@extends('layouts.index')

@section('title', 'ツイート検索')

@section('content')
    @empty($errors)

    @else
    <div class="card-panel red darken-2">
        <ul>
            @error('keyword')
            <li class="white-text">{{$message}}</li>
            @enderror
        </ul>
    </div>
    @endempty
    <div class="row">
        <form class="col s12" action="/search" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="input_text" type="text" name="keyword" value="{{old('keyword')}}">
                    <label for="input_text">キーワード</label>
                </div>
            </div>
            <button class="col s4 offset-s4 btn waves-effect waves-light deep-purple" type="submit">検索
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>

    <section>
    @isset($tweets)
        @foreach($tweets->statuses as $tweet)
        <div class="row card deep-purple">
            <div class="col s12 m12 card-content white-text deep-purple">
                <p>ユーザー名：{{$tweet->user->name}}</p>
                <span class="card-title">投稿内容</span>
                <p>{{$tweet->text}}</p>
            </div>
        </div>
        @endforeach
    @endisset
    </section>
@endsection