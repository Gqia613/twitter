@extends('layouts.index')

@section('title', 'いいね')

@section('content')
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
            <button class="btn waves-effect waves-light deep-purple" type="submit">いいねする
                <i class="material-icons right">send</i>
            </button>
            <!-- <input type="submit" value="いいねする"> -->
        </form>
    </div>
@endsection