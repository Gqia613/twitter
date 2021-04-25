@extends('layouts.index')

@section('title', 'デバック')

@section('menu')
    <a href="/">マイページに戻る</a>
@endsection

@section('content')
        {{$date}}
        <table border=1>
            <tr>
                <th>アクセストークン</th>
                <th>アクセストークンシークレット</th>
            </tr>
            @foreach($tokens as $token)
            <tr>
                <td>{{$token->access_token}}</td>
                <td>{{$token->access_token_secret}}</td>
            </tr>
            @endforeach
        </table>

@endsection