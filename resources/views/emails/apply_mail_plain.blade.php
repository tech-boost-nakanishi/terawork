{{ $corporate_name }} {{ $contact_name }}様

いつもご利用ありがとうございます。
以前投稿いただきました
「{{ $rectitle }}」に
応募がありましたのでご連絡致しました。

応募者情報
=================================
お名前：{{ $username }}
フリガナ：{{ $phonetic }}
生年月日：{{ $birth_year }}/{{ $birth_month }}/{{ $birth_day }}
年齢：{{ $age }}歳
お住いの都道府県：{{ $live_pref_name }}
メールアドレス：{{ $email }}
電話番号：{{ $phone }}
=================================

{{ $username }}さんのプロフィール
{{ action('ApplyController@profile', ['id' => $user_id]) }}

{{ $username }}さんとのメッセージはこちら
{{ action('MessageController@corporateshow', ['id' => $apply_id]) }}

{{ url('/') }}