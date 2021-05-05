@extends('layouts.index')

@section('title', 'いいね')

@section('content')
    @empty($error)

    @else
    <div class="card-panel red darken-2">
        <ul>
            @error('keyword')
            <li class="white-text">{{$message}}</li>
            @enderror
            @error('num')
            <li class="white-text">{{$message}}</li>
            @enderror
        </ul>
    </div>
    @endempty
    <div class="row">
        <form class="col s12" action="/favorite" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s12">
                    <input id="input_text" type="text" name="keyword" value="{{old('keyword')}}">
                    <label for="input_text">キーワード</label>
                </div>
                <div class="input-field col s12">
                    <input id="input_text" type="text" name="num" value="{{old('num')}}">
                    <label for="input_text">ツイート数</label>
                </div>
            </div>
            <button class="col s4 offset-s4 btn waves-effect waves-light deep-purple" type="submit">いいねする
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
@endsection