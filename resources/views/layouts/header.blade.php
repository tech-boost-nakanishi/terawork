@section('header')
<nav class="navbar navbar-expand-sm navbar-light" style="background-color: #444;">
    <h1 style="margin: 0;"><a class="navbar-brand" href="/" style="color: #fff; font-size: 26px;">{{ config('app.name') }}</a></h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" style="border-color: rgba(255,255,255,.3);">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <ul class="navbar-nav">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('login') }}" style="color: #fff; font-size: 16px;">ログイン</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('register') }}" style="color: #fff; font-size: 16px;">新規登録</a>
                </li>
            @endguest
            @auth('corporate')
                <li class="dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff; font-size: 16px;">
                        {{ Auth::guard('corporate')->user()->contact_name }}さん <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-top: 10px; font-size: 18px;">
                        <a class="dropdown-item" href="{{ route('corporate.dashboard') }}">
                            マイページ
                        </a>
                        <a class="dropdown-item" href="{{ action('RecruitController@profile', ['id' => Auth::guard('corporate')->user()->id]) }}">
                            プロフィール
                        </a>
                        <a class="dropdown-item" href="{{ action('RecruitController@add') }}">
                            募集する
                        </a>
                        <a class="dropdown-item" href="{{ url('corporate/logout') }}">
                            ログアウト
                        </a>
                    </div>
                </li>
            @elseauth('user')
                <li class="dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff; font-size: 16px;">
                        {{ Auth::guard('user')->user()->name }}さん <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="margin-top: 10px; font-size: 18px;">
                        <a class="dropdown-item" href="{{ action('ApplyController@index') }}">
                            マイページ
                        </a>
                        <a class="dropdown-item" href="{{ action('ApplyController@profile', ['id' => Auth::guard('user')->user()->id]) }}">
                            プロフィール
                        </a>
                        <a class="dropdown-item" href="{{ url('logout') }}">
                            ログアウト
                        </a>
                    </div>
                </li>
            @endauth
        </ul>
    </div>
</nav>
@endsection