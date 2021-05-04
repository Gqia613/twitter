@extends('layouts.index')

@section('title', 'アカウント連携')

@section('content')
<div class="row">
    <form action="/autofallow" method="post">
        @csrf
        <button class="col s4 offset-s4 btn waves-effect waves-light deep-purple" type="submit">連携する
            <i class="material-icons right">send</i>
        </button>
    </form>
</div>

@endsection