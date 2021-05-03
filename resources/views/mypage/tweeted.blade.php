@extends('layouts.index')

@section('title', '投稿済み一覧')

@section('content')
    <section>
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
        </div>
        @endforeach
    </section>
@endsection