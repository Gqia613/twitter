@extends('layouts.index')

@section('title', '投稿済み一覧')

@section('content')
    <section>
        @foreach($items as $item)
            <div class="row card deep-purple">
                @php            
                    $time1 = mb_substr($item->reservation_time , 0, 10);
                    $year = mb_substr($time1 , 0, 4);
                    $month = mb_substr($time1 , 5, 2);
                    $day = mb_substr($time1 , 8, 2);
                    $time2 = mb_substr($item->reservation_time , 11, 5);
                    $total = $year . '/' . $month . '/' . $day . ' ' . $time2;   
                @endphp
                <div class="col s12 m12 card-content white-text deep-purple">
                    <p class="reservation_time">予約時間：{{$total}}</p>
                    <span class="card-title">投稿内容</span>
                    <p>{{$item->content}}</p>
                </div>
            </div>
        @endforeach
    </section>
@endsection