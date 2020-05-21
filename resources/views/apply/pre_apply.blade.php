@extends('layouts.common')
@section('title', '求人応募申請画面 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')
@if(session('applied'))
    <div class="alert alert-danger" role="alert" style="width: 100%;">{{ session('applied') }}</div>
@endif

@if(session('applysuccess'))
    <div class="alert alert-success" role="alert" style="width: 100%;">{{ session('applysuccess') }}</div>
@endif

<h2>求人応募申請画面</h2>

<form action="{{ action('ApplyController@apply', ['id' => $recid]) }}" method="POST" enctype="multipart/form-data">
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
    	@if($errors->has('birth_yaer') || $errors->has('birth_month') || $errors->has('birth_day'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">生年月日を選択してください</div>
		@endif
        <label class="col-md-12" for="phonetic">生年月日</label>
        <div class="col-md-3">
            <select name="birth_year" class="form-control">
            	<option value="" @if(old('birth_year') == "") selected @endif>年</option>
            	@for($i=1900; $i<=date('Y'); $i++)
            		<option value="{{ $i }}" @if(old('birth_year') == $i) selected @endif>{{ $i }}</option>
            	@endfor
            </select>
        </div>
        <div class="col-md-3">
            <select name="birth_month" class="form-control">
				<option value="" @if(old('birth_month') == "") selected @endif>月</option>
				@for($i=1; $i<=12; $i++)
            		<option value="{{ $i }}" @if(old('birth_month') == $i) selected @endif>{{ $i }}</option>
            	@endfor
			</select>
        </div>
        <div class="col-md-3">
            <select name="birth_day" class="form-control">
				<option value="" @if(old('birth_day') == "") selected @endif>日</option>
				@for($i=1; $i<=31; $i++)
            		<option value="{{ $i }}" @if(old('birth_day') == $i) selected @endif>{{ $i }}</option>
            	@endfor
			</select>
        </div>
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
		@if($errors->has('live_pref_name'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('live_pref_name') }}</div>
		@endif
        <label class="col-md-12" for="live_pref_name">お住いの都道府県</label>
        <div class="col-md-3">
            <select name="live_pref_name" class="form-control">
                <option value="" @if(old('live_pref_name') == "") selected @endif>選択してください</option>
                <option value="北海道" @if(old('live_pref_name') == "北海道") selected @endif>北海道</option>
                <option value="青森県" @if(old('live_pref_name') == "青森県") selected @endif>青森県</option>
                <option value="岩手県" @if(old('live_pref_name') == "岩手県") selected @endif>岩手県</option>
                <option value="宮城県" @if(old('live_pref_name') == "宮城県") selected @endif>宮城県</option>
                <option value="秋田県" @if(old('live_pref_name') == "秋田県") selected @endif>秋田県</option>
                <option value="山形県" @if(old('live_pref_name') == "山形県") selected @endif>山形県</option>
                <option value="福島県" @if(old('live_pref_name') == "福島県") selected @endif>福島県</option>
                <option value="茨城県" @if(old('live_pref_name') == "茨城県") selected @endif>茨城県</option>
                <option value="栃木県" @if(old('live_pref_name') == "栃木県") selected @endif>栃木県</option>
                <option value="群馬県" @if(old('live_pref_name') == "群馬県") selected @endif>群馬県</option>
                <option value="埼玉県" @if(old('live_pref_name') == "埼玉県") selected @endif>埼玉県</option>
                <option value="千葉県" @if(old('live_pref_name') == "千葉県") selected @endif>千葉県</option>
                <option value="東京都" @if(old('live_pref_name') == "東京都") selected @endif>東京都</option>
                <option value="神奈川県" @if(old('live_pref_name') == "神奈川県") selected @endif>神奈川県</option>
                <option value="新潟県" @if(old('live_pref_name') == "新潟県") selected @endif>新潟県</option>
                <option value="富山県" @if(old('live_pref_name') == "富山県") selected @endif>富山県</option>
                <option value="石川県" @if(old('live_pref_name') == "石川県") selected @endif>石川県</option>
                <option value="福井県" @if(old('live_pref_name') == "福井県") selected @endif>福井県</option>
                <option value="山梨県" @if(old('live_pref_name') == "山梨県") selected @endif>山梨県</option>
                <option value="長野県" @if(old('live_pref_name') == "長野県") selected @endif>長野県</option>
                <option value="岐阜県" @if(old('live_pref_name') == "岐阜県") selected @endif>岐阜県</option>
                <option value="静岡県" @if(old('live_pref_name') == "静岡県") selected @endif>静岡県</option>
                <option value="愛知県" @if(old('live_pref_name') == "愛知県") selected @endif>愛知県</option>
                <option value="三重県" @if(old('live_pref_name') == "三重県") selected @endif>三重県</option>
                <option value="滋賀県" @if(old('live_pref_name') == "滋賀県") selected @endif>滋賀県</option>
                <option value="京都府" @if(old('live_pref_name') == "京都府") selected @endif>京都府</option>
                <option value="大阪府" @if(old('live_pref_name') == "大阪府") selected @endif>大阪府</option>
                <option value="兵庫県" @if(old('live_pref_name') == "兵庫県") selected @endif>兵庫県</option>
                <option value="奈良県" @if(old('live_pref_name') == "奈良県") selected @endif>奈良県</option>
                <option value="和歌山県" @if(old('live_pref_name') == "和歌山県") selected @endif>和歌山県</option>
                <option value="鳥取県" @if(old('live_pref_name') == "鳥取県") selected @endif>鳥取県</option>
                <option value="島根県" @if(old('live_pref_name') == "島根県") selected @endif>島根県</option>
                <option value="岡山県" @if(old('live_pref_name') == "岡山県") selected @endif>岡山県</option>
                <option value="広島県" @if(old('live_pref_name') == "広島県") selected @endif>広島県</option>
                <option value="山口県" @if(old('live_pref_name') == "山口県") selected @endif>山口県</option>
                <option value="徳島県" @if(old('live_pref_name') == "徳島県") selected @endif>徳島県</option>
                <option value="香川県" @if(old('live_pref_name') == "香川県") selected @endif>香川県</option>
                <option value="愛媛県" @if(old('live_pref_name') == "愛媛県") selected @endif>愛媛県</option>
                <option value="高知県" @if(old('live_pref_name') == "高知県") selected @endif>高知県</option>
                <option value="福岡県" @if(old('live_pref_name') == "福岡県") selected @endif>福岡県</option>
                <option value="佐賀県" @if(old('live_pref_name') == "佐賀県") selected @endif>佐賀県</option>
                <option value="長崎県" @if(old('live_pref_name') == "長崎県") selected @endif>長崎県</option>
                <option value="熊本県" @if(old('live_pref_name') == "熊本県") selected @endif>熊本県</option>
                <option value="大分県" @if(old('live_pref_name') == "大分県") selected @endif>大分県</option>
                <option value="宮崎県" @if(old('live_pref_name') == "宮崎県") selected @endif>宮崎県</option>
                <option value="鹿児島県" @if(old('live_pref_name') == "鹿児島県") selected @endif>鹿児島県</option>
                <option value="沖縄県" @if(old('live_pref_name') == "沖縄県") selected @endif>沖縄県</option>
            </select>
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