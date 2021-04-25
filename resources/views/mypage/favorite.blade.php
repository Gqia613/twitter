@extends('layouts.index')

@section('title', 'いいね')

@section('menu')
    <a href="/">マイページに戻る</a>
@endsection

@section('content')
    <form action="/favorite" method="post">
        @csrf
        <table>
            <tr>
                <th>キーワード</th>
                <td><input type="text" name="keyword"></td>
            </tr>
            <tr>
                <th>数</th>
                <td><input type="text" name="num"></td>
            </tr>
            <tr>
                <th></th>
                <td><input type="submit" value="いいねする"></td>
            </tr>
        </table>
    </form>

@endsection