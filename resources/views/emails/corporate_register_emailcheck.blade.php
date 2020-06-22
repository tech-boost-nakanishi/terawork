<!DOCTYPE html>
<html>
<body>
	<p>
		この度は登録ありがとうございます。<br>
		下記の本登録用のリンクをクリックし本登録を完了させてください。
	</p>
	<p>
		<a href="{{ url('corporate/register/emailcheck/' . $email . '/' . $token) }}">
			{{ url('corporate/register/emailcheck/' . $email . '/' . $token) }}
		</a>
	</p>
	<p><a href="{{ url('/') }}">{{ config('app.name') }}</a></p>
</body>
</html>