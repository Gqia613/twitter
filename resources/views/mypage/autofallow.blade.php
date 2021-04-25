@extends('layouts.index')

@section('title', '自動投稿')

@section('menu')
    <a href="/">マイページに戻る</a>
@endsection

@section('content')
    <form action="/autofallow" method="post">
        @csrf
        <input type="submit" value="自動化">
    </form>

@endsection