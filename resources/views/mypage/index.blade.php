@extends('layouts.index')

@section('title', 'ツイッター')

@empty($token)
    @section('menu')
    <a href="/autofallow">アカウント連携</a>
    @endsection
@else
    @section('main')
        @error('reservation_time')
            <p>{{$message}}</p>
        @enderror
        @error('content')
            <p>{{$message}}</p>
        @enderror
        <div class="row">
            <form action="/" method="post">
                @csrf
                @isset($userId)
                <input type="hidden" name="user_id" value="{{$userId}}">
                @endisset
                <input type="hidden" name="del_flag" value="0">
                <div class="input-field col s12">
                    <input type="datetime-local" name="reservation_time" step="60" value="{{old('reservation_time')}}">
                </div>
                <div class="input-field col s12">
                    <textarea id="textarea2" class="materialize-textarea" name="content" value="{{old('content')}}" data-length="120"></textarea>
                    <label for="textarea2">テキストエリア</label>
                </div>
                <button class="btn waves-effect waves-light deep-purple" type="submit" name="action">設定
                    <i class="material-icons right">send</i>
                </button>
                <!-- <input class="button" type="submit" value="設定する"> -->
            </form>
        </div>
    @endsection

    @section('content')
        <section>
        @if(isset($items))
            @foreach($items as $item)
            <div class="contents">
                @php            
                    $time1 = mb_substr($item->reservation_time , 0, 10);
                    $year = mb_substr($time1 , 0, 4);
                    $month = mb_substr($time1 , 5, 2);
                    $day = mb_substr($time1 , 8, 2);
                    $time2 = mb_substr($item->reservation_time , 11, 5);
                    $total = $year . '/' . $month . '/' . $day . ' ' . $time2;   
                @endphp
                <p class="reservation_time">予約時間：{{$total}}</p>
                <h3>投稿内容</h3>
                <p class="content">{{$item->content}}</p>
                <form action="/delete" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <input class="button" type="submit" value="取消">
                </form>
            </div>
            @endforeach
        @endif
        </section>
    @endsection
@endempty
