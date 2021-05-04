@extends('layouts.index')

@section('title', 'アカウント連携')

@section('content')
    <form action="/autofallow" method="post">
        @csrf
        <button class="btn waves-effect waves-light deep-purple" type="submit" name="action">連携する
            <i class="material-icons right">send</i>
        </button>
        <!-- <input type="submit" value="自動化"> -->
    </form>

@endsection