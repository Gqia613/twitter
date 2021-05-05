@extends('layouts.index')

@section('title', 'いいね')

@section('content')
    @error('keyword')
        <p class="center">{{$message}}</p>
    @enderror
    @error('num')
        <p class="center">{{$message}}</p>
    @enderror
    <div class="row">
        <form class="col s12" action="/favorite" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="input_text" type="text" name="keyword">
                    <label for="input_text">キーワード</label>
                </div>
                <div class="input-field col s12">
                    <input id="input_text" type="text" name="num">
                    <label for="input_text">ツイート数</label>
                </div>
            </div>
            <button class="col s4 offset-s4 btn waves-effect waves-light deep-purple" type="submit">いいねする
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
@endsection