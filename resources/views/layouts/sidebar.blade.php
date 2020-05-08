@section('sidebar')
<div class="sidebar col-md-2">
    <table class="table table-striped text-center table-bordered">
        <form>
            <thead>
                <tr>
                    <th style="color: #000; font-size: 18px;">条件で絞る</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight: bold;">都道府県</td>
                </tr>
                <tr>
                    <td>
                        <select name="pref_name" class="form-control">
                            <option value="" selected>選択してください</option>
                            <option value="北海道">北海道</option>
                            <option value="青森県">青森県</option>
                            <option value="岩手県">岩手県</option>
                            <option value="宮城県">宮城県</option>
                            <option value="秋田県">秋田県</option>
                            <option value="山形県">山形県</option>
                            <option value="福島県">福島県</option>
                            <option value="茨城県">茨城県</option>
                            <option value="栃木県">栃木県</option>
                            <option value="群馬県">群馬県</option>
                            <option value="埼玉県">埼玉県</option>
                            <option value="千葉県">千葉県</option>
                            <option value="東京都">東京都</option>
                            <option value="神奈川県">神奈川県</option>
                            <option value="新潟県">新潟県</option>
                            <option value="富山県">富山県</option>
                            <option value="石川県">石川県</option>
                            <option value="福井県">福井県</option>
                            <option value="山梨県">山梨県</option>
                            <option value="長野県">長野県</option>
                            <option value="岐阜県">岐阜県</option>
                            <option value="静岡県">静岡県</option>
                            <option value="愛知県">愛知県</option>
                            <option value="三重県">三重県</option>
                            <option value="滋賀県">滋賀県</option>
                            <option value="京都府">京都府</option>
                            <option value="大阪府">大阪府</option>
                            <option value="兵庫県">兵庫県</option>
                            <option value="奈良県">奈良県</option>
                            <option value="和歌山県">和歌山県</option>
                            <option value="鳥取県">鳥取県</option>
                            <option value="島根県">島根県</option>
                            <option value="岡山県">岡山県</option>
                            <option value="広島県">広島県</option>
                            <option value="山口県">山口県</option>
                            <option value="徳島県">徳島県</option>
                            <option value="香川県">香川県</option>
                            <option value="愛媛県">愛媛県</option>
                            <option value="高知県">高知県</option>
                            <option value="福岡県">福岡県</option>
                            <option value="佐賀県">佐賀県</option>
                            <option value="長崎県">長崎県</option>
                            <option value="熊本県">熊本県</option>
                            <option value="大分県">大分県</option>
                            <option value="宮崎県">宮崎県</option>
                            <option value="鹿児島県">鹿児島県</option>
                            <option value="沖縄県">沖縄県</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">月収</td>
                </tr>
                <tr>
                    <td>
                        <input type="number" class="form-control" name="keyword" value="" style="width: 65px; display: inline; margin: 0 5px;">万円以上
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">言語</td>
                </tr>
                <tr>
                    <td>
                        <select name="language" class="form-control">
                            <option value="" selected>選択してください</option>
                            @foreach($languages as $lang)
                                <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">フリーワード</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="form-control" name="keyword" value="" placeholder="例) PHP 大阪">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" class="btn btn-primary" value="検索">
                    </td>
                </tr>
            </tbody>
            {{ csrf_field() }}
        </form>
    </table>
</div>
@endsection