@extends('layouts.index')

@section('title', 'いいね')

@section('content')
    <!-- <form action="/favorite" method="post">
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
    </form> -->
    <div class="row">
        <form class="col s12" action="/favorite" method="post">
            @csrf
            <div class="row">
                <div class="input-field col s6">
                    <input id="input_text" type="text" name="keyword">
                    <label for="input_text">キーワード</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="input_text" type="text" name="num">
                    <label for="input_text">ツイート数</label>
                </div>
            </div>
            <input type="submit" value="いいねする">
        </form>
    </div>

@endsection