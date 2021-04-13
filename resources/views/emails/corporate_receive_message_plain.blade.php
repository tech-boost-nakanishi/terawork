{{ $corporate_name }} {{ $contact_name }}様

いつもご利用ありがとうございます。
{{ $username }}さんからメッセージが届きました。

{{ $username }}さんとのメッセージはこちら
{{ action('MessageController@corporateshow', ['id' => $apply_id]) }}

{{ url('/') }}