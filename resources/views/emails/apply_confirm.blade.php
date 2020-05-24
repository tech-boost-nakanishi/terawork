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
		募集企業からの返信をお待ちください。
	</p>

	<p>
		もし1週間ほど待っても返信がない場合は下記のメールアドレスより<br>
		直接募集企業にお問い合わせください。<br>
		<a href="mailto:{{ $corporate_email }}">{{ $corporate_email }}</a>
	</p>

	<p><a href="{{ url('/') }}">{{ config('app.name') }}</a></p>
</body>
</html>