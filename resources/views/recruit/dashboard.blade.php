@extends('layouts.common')
@section('title', 'マイページ - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')
@if(session('register'))
    <div class="alert alert-info" role="alert" style="width: 100%;">{{ session('register') }}</div>
@endif

@if(session('login'))
    <div class="alert alert-info" role="alert" style="width: 100%;">{{ session('login') }}</div>
@endif

@if(session('recruitdelete'))
    <div class="alert alert-danger" role="alert" style="width: 100%;">{{ session('recruitdelete') }}</div>
@endif

<h2>掲載者マイページ</h2>

<h5 style="font-weight: bold; margin-top: 20px;">投稿求人一覧</h5>
<table class="table table-bordered">
    <thead class="thead-dark">
        <th width="20%">日時</th>
        <th width="35%">タイトル</th>
        <th width="13%">ステータス</th>
        <th width="12%">応募者</th>
        <th width="20%">操作</th>
    </thead>
    <tbody>
        @foreach($recruits as $rec)
            <tr>
                <td>{{ $rec->created_at->format('Y年m月d日 H:i') }}</td>
                <td><a href="{{ action('RecruitController@show', ['id' => $rec->id]) }}">{{ $rec->title }}</a></td>
                <td>{{ $rec->status }}</td>
                <td>
                    <a href="{{ action('RecruitController@appliedlist', ['id' => $rec->id]) }}">一覧({{ count($rec->applies) }})</a>
                </td>
                <td>
                    <a href="{{ route('recruit.edit', ['id' => $rec->id]) }}" class="btn btn-info">編集</a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $rec->id }}">削除</a>
                </td>
            </tr>

            <div class="modal fade" id="deleteModal{{ $rec->id }}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">削除確認画面</h4>
                        </div>
                        <div class="modal-body">
                            <label>「{{ $rec->title }}」を削除しますか？</label>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">閉じる</a>
                            <a href="{{ action('RecruitController@delete', ['id' => $rec->id]) }}" class="btn btn-danger">削除</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $recruits->appends(request()->input())->links() }}
</div>

<a href="{{ action('RecruitController@pre_cancel', ['id' => Auth::guard('corporate')->user()->id]) }}" class="btn btn-danger float-right mt-4">退会する</a>

@endsection
@include('layouts.footer')