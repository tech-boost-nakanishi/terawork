<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<h3>{{ $name }}様</h3>

	<p>
		いつもご利用ありがとうございます。<br>
		企業からメッセージが届きました。<br>
	</p>

	<p>
		企業からのメッセージはこちら<br>
		<a href="{{ action('MessageController@usershow', ['id' => $apply_id]) }}">{{ action('MessageController@usershow', ['id' => $apply_id]) }}</a>
	</p>

	<p><a href="{{ url('/') }}">{{ config('app.name') }}</a></p>
</body>
</html>