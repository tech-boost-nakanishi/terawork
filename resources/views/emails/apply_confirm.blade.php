<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		a {
			text-decoration: none;
		}
	</style>
</head>
<body>
	<h3>{{ $name }}様</h3>

	<p>
		いつもご利用ありがとうございます。<br>
		応募が完了しましたのでお知らせいたします。<br>
		募集企業からのメッセージをお待ちください。
	</p>

	<p>
		この求人のメッセージはこちら<br>
		<a href="{{ action('MessageController@usershow', ['id' => $apply_id]) }}">{{ action('MessageController@usershow', ['id' => $apply_id]) }}</a>
	</p>

	<p><a href="{{ url('/') }}">{{ config('app.name') }}</a></p>
</body>
</html>