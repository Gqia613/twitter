@extends('layouts.index')

@section('title', 'ホーム')

@empty($token)
    @section('menu')
    <a href="/autofallow">自動化する</a>
    @endsection
@else
    @section('menu')
    <div class=" navbar-fixed">
        <nav class="nav-wraper  deep-purple">
            <div class="cotainer">
                <!--ハンバーガーメニューの開くアイコン-->
                <a href="#" class="sidenav-trigger right" data-target="mobile-links">
                    <i class="material-icons">menu</i>
                </a>

                <div class="menu">

                    <ul class="right hide-on-med-and-down">
                        <li><a href="/tweeted" class="grey-text text-lighten-3">投稿済み一覧</a></li>
                        <li><a href="/search" class="grey-text text-lighten-3">Tweet検索</a></li>
                        <li><a href="/favorite" class="grey-text text-lighten-3">いいねする</a></li>
                    </ul>
                </div>

            </div>
        </nav>
    </div>

    <ul class="sidenav" id="mobile-links">
        <!--ハンバーガーメニューの閉じるアイコン-->
        <a href="#" class="sidenav-close " data-target="mobile-links">
            <i class="material-icons close-icon">close</i>
        </a>

        <div class="menu">
            <li><a href="/tweeted">投稿済み一覧</a></li>
            <li><a href="/search">Tweet検索</a></li>
            <li><a href="/favorite">いいねする</a></li>
        </div>
    </ul>
        <!-- <a href="/tweeted">投稿済み一覧</a>
        <a href="/search">検索</a>
        <a href="/favorite">いいねする</a> -->
    @endsection

    @section('main')
        @error('reservation_time')
            <p>{{$message}}</p>
        @enderror
        @error('content')
            <p>{{$message}}</p>
        @enderror
        <table>
        <form action="/" method="post">
            @csrf
            @isset($userId)
            <input type="hidden" name="user_id" value="{{$userId}}">
            @endisset
            <input type="hidden" name="del_flag" value="0">
            <tr>
                <th>日付</th>
            </tr>
            <tr>
                <td><input type="datetime-local" name="reservation_time" step="60" value="{{old('reservation_time')}}"></td>
            </tr>
            <tr>
                <th>投稿内容</th>
            </tr>
            <tr>
                <td><textarea cols="30" rows="7" name="content" value="{{old('content')}}"></textarea></td>
            </tr>
            <tr>
                <td><input class="button" type="submit" value="設定する"></td>
            </tr>
        </form>
        </table>
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
