<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
    <div class=" navbar-fixed">
        <nav class="nav-wraper  deep-purple">
            <div class="cotainer">
                <!--ハンバーガーメニューの開くアイコン-->
                <a href="#" class="sidenav-trigger right" data-target="mobile-links">
                    <i class="material-icons">menu</i>
                </a>

                <div class="menu">

                    <ul class="right hide-on-med-and-down">
                        <li><a href="/" class="grey-text text-lighten-3">マイページに戻る</a></li>
                        <li><a href="/tweeted" class="grey-text text-lighten-3">投稿済み一覧</a></li>
                        <li><a href="/search" class="grey-text text-lighten-3">ツイート検索</a></li>
                        <li><a href="/favorite" class="grey-text text-lighten-3">いいねする</a></li>
                        <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            {{ __('ログアウト') }}
                        </a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
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
            <li><a href="/"><i class="material-icons">home</i>トップに戻る</a></li>
            <li><a href="/tweeted"><i class="material-icons">history</i>投稿済み一覧</a></li>
            <li><a href="/search"><i class="material-icons">search</i>Tweet検索</a></li>
            <li><a href="/favorite"><i class="material-icons">favorite</i>いいねする</a></li>
            <li>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <i class="material-icons">directions_run</i>{{ __('ログアウト') }}
            </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </ul>

    <h4 class="center">@yield('title')</h4>

    @yield('main')

    @yield('content')
    <script src="js/nav-bar.js"></script>
</body>
</html>