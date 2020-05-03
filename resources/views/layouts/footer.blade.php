@section('footer')
<footer>
    <div class="row">
        <div class="col-md-3"></div>
        <ul>
            <li><a href="#">ホーム</a></li>
            <li><a href="#">掲載企業一覧</a></li>
            <li><a href="#">{{ config('app.name') }}について</a></li>
        </ul>

        <ul>
            <li><a href="#">求人に応募する</a></li>
            <li><a href="#">求人を掲載する</a></li>
        </ul>
    </div>
    <span>(C) 2020 {{ config('app.name') }} all rights reserved.</span>
</footer>
@endsection