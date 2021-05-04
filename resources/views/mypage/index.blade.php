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
                <button class="btn waves-effect waves-light deep-purple" type="submit">設定
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
            <div class="row card blue-grey darken-1">
                @php            
                    $time1 = mb_substr($item->reservation_time , 0, 10);
                    $year = mb_substr($time1 , 0, 4);
                    $month = mb_substr($time1 , 5, 2);
                    $day = mb_substr($time1 , 8, 2);
                    $time2 = mb_substr($item->reservation_time , 11, 5);
                    $total = $year . '/' . $month . '/' . $day . ' ' . $time2;   
                @endphp
                <div class="col s12 m6 card-content white-text deep-purple">
                    <p class="reservation_time">予約時間：{{$total}}</p>
                    <span class="card-title">投稿内容</span>
                    <p>{{$item->content}}</p>
                </div>
                <div class="col s12 m6 card-action deep-purple">
                    <form action="/delete" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->id}}">
                        <button class="col s6 offset-s6 btn waves-effect waves-light deep-purple lighten-2" type="submit">
                            <i class="material-icons small">delete_forever</i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        @endif
        </section>
    @endsection
@endempty
