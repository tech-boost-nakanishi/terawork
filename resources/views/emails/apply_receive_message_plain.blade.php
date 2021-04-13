{{ $name }}様

いつもご利用ありがとうございます。
企業からメッセージが届きました。

企業からのメッセージはこちら
{{ action('MessageController@usershow', ['id' => $apply_id]) }}

{{ url('/') }}