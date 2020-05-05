@extends('layouts.common')
@section('title', '新規登録 - ' . config('app.name'))

@include('layouts.header')
@section('auth')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">掲載者として新規登録</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('corporate.register.submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="corporate_name" class="col-md-4 col-form-label text-md-right">会社名</label>

                            <div class="col-md-6">
                                <input id="corporate_name" type="text" class="form-control @error('corporate_name') is-invalid @enderror" name="corporate_name" value="{{ old('corporate_name') }}" required autocomplete="corporate_name" autofocus>

                                @error('corporate_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact_name" class="col-md-4 col-form-label text-md-right">担当者名</label>

                            <div class="col-md-6">
                                <input id="contact_name" type="text" class="form-control @error('contact_name') is-invalid @enderror" name="contact_name" value="{{ old('contact_name') }}" required autocomplete="contact_name" autofocus>

                                @error('contact_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">メールアドレス</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワード(確認用)</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    登録
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <p style="text-align: center;">アカウントをお持ちの方は<a href="{{ url('corporate/login') }}">こちら</a></p>
            <h4 style="text-align: center; margin-top: 50px;">求人に応募したい方は<a href="{{ url('login') }}">こちら</a></h4>
        </div>
    </div>
</div>
@endsection
@include('layouts.footer')