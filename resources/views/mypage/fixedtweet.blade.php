@extends('layouts.index')

@section('title', '固定ツイート設定')

@section('main')
    @empty($errors->all())

    @else
    <div class="card-panel red darken-2">
        <ul>
            @error('fixed_tweet_flg')
            <li class="white-text">{{$message}}</li>
            @enderror
            @error('content1')
            <li class="white-text">{{$message}}</li>
            @enderror
            @error('content2')
            <li class="white-text">{{$message}}</li>
            @enderror
            @error('content3')
            <li class="white-text">{{$message}}</li>
            @enderror
        </ul>
    </div>
    @endempty
    <div class="row">
        <form action="/fixedtweet" method="post">
            @csrf
            @isset($userId)
            <input type="hidden" name="user_id" value="{{$userId}}">
            @endisset
            <div class="row">
                <p class="col s12 m12 right">固定ツイート：{{$fixedContent->fixed_tweet_flg}}</p>
                <p class="col s4 m2">
                <label>
                    <input class="with-gap" name="fixed_tweet_flg" type="radio" value="0"
                    @if($fixedContent->fixed_tweet_flg != null)
                        @if($fixedContent->fixed_tweet_flg == '0')
                        checked
                        @endif 
                    @endif
                    />
                    <span>する</span>
                </label>
                </p>
                <p class="col s4 m2">
                <label>
                    <input class="with-gap" name="fixed_tweet_flg" type="radio" value="1"
                    @if($fixedContent->fixed_tweet_flg != null)
                        @if($fixedContent->fixed_tweet_flg == '1')
                        checked
                        @endif 
                    @endif
                    />
                    <span>しない</span>
                </label>
                </p>
            </div>
            <div class="input-field col s12">
                <textarea id="textarea2" class="materialize-textarea" name="content1" data-length="120">@empty($fixedContent->content1)@else{{$fixedContent->content1}}@endempty</textarea>
                <label for="textarea2">6時30分 投稿内容</label>
            </div>
            <div class="input-field col s12">
                <textarea id="textarea3" class="materialize-textarea" name="content2" data-length="120">@empty($fixedContent->content2)@else{{$fixedContent->content2}}@endempty</textarea>
                <label for="textarea3">12時30分 投稿内容</label>
            </div>
            <div class="input-field col s12">
                <textarea id="textarea4" class="materialize-textarea" name="content3" data-length="120">@empty($fixedContent->content3)@else{{$fixedContent->content3}}@endempty</textarea>
                <label for="textarea4">19時30分 投稿内容</label>
            </div>
            <button class="col s4 offset-s4 btn waves-effect waves-light deep-purple" type="submit">設定
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
@endsection