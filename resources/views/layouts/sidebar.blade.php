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
                    <td>2</td>
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
                    <td>5</td>
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