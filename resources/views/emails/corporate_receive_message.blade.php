<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<h3>{{ $corporate_name }} {{ $contact_name }}様</h3>

	<p>
		いつもご利用ありがとうございます。<br>
		{{ $username }}さんからメッセージが届きました。
	</p>

	<p>
		{{ $username }}さんとのメッセージはこちら
		<a href="{{ action('MessageController@corporateshow', ['id' => $apply_id]) }}">{{ action('MessageController@corporateshow', ['id' => $apply_id]) }}</a>
	</p>

	<p><a href="{{ url('/') }}">{{ config('app.name') }}</a></p>
</body>
</html>