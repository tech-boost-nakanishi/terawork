@extends('layouts.common')
@section('title', '求人応募申請画面 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2>求人応募申請画面</h2>

<form action="{{ action('Applycontroller@apply', ['id' => $recid]) }}" method="post" enctype="multipart/form-data">
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
            <select name="birth_year" class="form-control">
            	<option value="">年</option>
            	@for($i=1900; $i<=date('Y'); $i++)
            		<option value="{{ $i }}">{{ $i }}</option>
            	@endfor
            </select>
        </div>
        <div class="col-md-3">
            <select name="birth_month" class="form-control">
				<option value="">月</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
			</select>
        </div>
        <div class="col-md-3">
            <select name="birth_day" class="form-control">
				<option value="">日</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				<option value="25">25</option>
				<option value="26">26</option>
				<option value="27">27</option>
				<option value="28">28</option>
				<option value="29">29</option>
				<option value="30">30</option>
				<option value="31">31</option>
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