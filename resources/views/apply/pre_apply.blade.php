@extends('layouts.common')
@section('title', '求人応募申請画面 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2>求人応募申請画面</h2>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group row">
		@if($errors->has('username'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('username') }}</div>
		@endif
        <label class="col-md-12" for="username">名前(フルネーム)</label>
        <div class="col-md-12">
        	<input type="text" class="form-control" name="username" value="{{ Auth::guard('user')->user()->name }}">
        </div>
    </div>
    <hr>
    <div class="form-group row">
		@if($errors->has('phonetic'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('phonetic') }}</div>
		@endif
        <label class="col-md-12" for="phonetic">フリガナ</label>
        <div class="col-md-12">
            <input type="text" class="form-control" name="phonetic" value="{{ old('phonetic') }}">
        </div>
    </div>
    <hr>
    <div class="form-group row">
		@if($errors->has('phonetic'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('phonetic') }}</div>
		@endif
        <label class="col-md-12" for="phonetic">生年月日</label>
        <div class="col-md-3">
            <input type="number" class="form-control" name="phonetic" value="{{ old('phonetic') }}" style="float: left;">
        </div>
        <span style="float: left; font-size: 26px;">/</span>
        <div class="col-md-3">
            <input type="number" class="form-control" name="phonetic" value="{{ old('phonetic') }}" style="float: left;">
        </div>
        <span style="float: left; font-size: 26px;">/</span>
        <div class="col-md-3">
            <input type="number" class="form-control" name="phonetic" value="{{ old('phonetic') }}">
        </div>
        <div style="clear: both;"></div>
    </div>
    <hr>
    <div class="form-group row">
		@if($errors->has('age'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('age') }}</div>
		@endif
        <label class="col-md-12" for="age">年齢</label>
        <div class="col-md-3">
            <input type="number" class="form-control" name="age" value="{{ old('age') }}">
        </div>
    </div>
    <hr>
    <div class="form-group row">
		@if($errors->has('age'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('age') }}</div>
		@endif
        <label class="col-md-12" for="age">お住いの都道府県</label>
        <div class="col-md-3">
            <input type="number" class="form-control" name="age" value="{{ old('age') }}">
        </div>
    </div>
    <hr>
    <div class="form-group row">
		@if($errors->has('email'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('email') }}</div>
		@endif
        <label class="col-md-12" for="email">メールアドレス</label>
        <div class="col-md-12">
            <input type="text" class="form-control" name="email" value="{{ Auth::guard('user')->user()->email }}">
        </div>
    </div>
    <hr>
    <div class="form-group row">
		@if($errors->has('phone'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('phone') }}</div>
		@endif
        <label class="col-md-12" for="phone">電話番号</label>
        <div class="col-md-12">
            <input type="tel" class="form-control" name="phone" size="10" maxlength="20" value="{{ old('phone') }}">
        </div>
    </div>

	{{ csrf_field() }}
    <input type="submit" value="応募する" class="btn btn-primary" style="display: block; width: 100px; margin: 20px auto;">
</form>
@endsection
@include('layouts.footer')