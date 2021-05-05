@extends('layouts.index')

@section('title', 'ツイッター')

@section('main')
    @empty($errors->all())

    @else
    <div class="card-panel red darken-2">
        <ul>
            @error('reservation_time')
            <li class="white-text">{{$message}}</li>
            @enderror
            @error('content')
            <li class="white-text">{{$message}}</li>
            @enderror
        </ul>
    </div>
    @endempty
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
                <textarea id="textarea2" class="materialize-textarea" name="content" data-length="120">{{old('content')}}</textarea>
                <label for="textarea2">投稿内容</label>
            </div>
            <button class="col s4 offset-s4 btn waves-effect waves-light deep-purple" type="submit">設定
                <i class="material-icons right">send</i>
            </button>
        </form>
    </div>
@endsection

@section('content')
    <section>
    @if(isset($items))
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
                <p>予約時間：{{$total}}</p>
                <span class="card-title">投稿内容</span>
                <p>{{$item->content}}</p>
            </div>
            <div class="col s12 m12 card-action deep-purple">
                <form action="/delete" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$item->id}}">
                    <button class="col s6 offset-s6 m6 offset-m6 btn waves-effect waves-light deep-purple lighten-2" type="submit">
                        <i class="material-icons small">delete_forever</i>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    @endif
    </section>
@endsection
