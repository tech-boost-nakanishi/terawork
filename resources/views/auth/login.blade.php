@extends('layouts.common')
@section('title', 'ログイン - ' . config('app.name'))

@include('layouts.header')
@section('auth')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">応募者としてログイン</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        ログインを保持する
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    ログイン
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        パスワードをお忘れですか？
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div class="form-group row mt-2">
                        <div class="col-md-8 offset-md-4">
                            <a href="/login/google" class="btn btn-info" role="button">
                                Googleでログイン
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <p style="text-align: center;">アカウントをお持ちでない方は<a href="{{ url('register') }}">こちら</a></p>
            <h4 style="text-align: center; margin-top: 50px;">求人を掲載したい方は<a href="{{ url('corporate/login') }}">こちら</a></h4>
        </div>
    </div>
</div>
@endsection

@include('layouts.footer')
