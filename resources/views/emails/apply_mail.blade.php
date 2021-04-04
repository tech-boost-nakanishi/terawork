<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<h3>{{ $corporate_name }} {{ $contact_name }}様</h3>

	<p>
		いつもご利用ありがとうございます。<br>
		以前投稿いただきました<br>
		「{{ $rectitle }}」に<br>
		応募がありましたのでご連絡致しました。
	</p>

	<p style="margin: 0; padding: 0; font-size: 15px; font-weight: bold;">応募者情報</p>
	<p style="margin: 0; padding: 0;">=================================</p>
	お名前：{{ $username }}<br>
	フリガナ：{{ $phonetic }}<br>
	生年月日：{{ $birth_year }}/{{ $birth_month }}/{{ $birth_day }}<br>
	年齢：{{ $age }}歳<br>
	お住いの都道府県：{{ $live_pref_name }}<br>
	メールアドレス：<a href="mailto:{{ $email }}">{{ $email }}</a><br>
	電話番号：{{ $phone }}
	<p style="margin: 0; padding: 0;">=================================</p>

	<p>{{ $username }}さんのプロフィールは<a href="{{ action('ApplyController@profile', ['id' => $user_id]) }}">こちら</a></p>

	<p>
		{{ $username }}さんとのメッセージはこちら
		<a href="{{ action('MessageController@corporateshow', ['id' => $apply_id]) }}">{{ action('MessageController@corporateshow', ['id' => $apply_id]) }}</a>
	</p>

	<p><a href="{{ url('/') }}">{{ config('app.name') }}</a></p>
</body>
</html>