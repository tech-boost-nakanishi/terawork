@section('header')
<nav class="navbar navbar-expand-sm navbar-light" style="background-color: #444;">
    <h1><a class="navbar-brand" href="/" style="color: #fff; font-size: 26px;">{{ config('app.name') }}</a></h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" style="border-color: rgba(255,255,255,.3);">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ url('login') }}" style="color: #fff; font-size: 16px;">ログイン</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('register') }}" style="color: #fff; font-size: 16px;">新規登録</a>
            </li>
        </ul>
    </div>
</nav>
@endsection