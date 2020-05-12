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

<h2>掲載者マイページ</h2>

<table class="table table-bordered" style="margin-top: 20px;">
    <thead class="thead-dark">
        <th width="20%">日時</th>
        <th width="35%">タイトル</th>
        <th width="13%">ステータス</th>
        <th width="12%">応募人数</th>
        <th width="20%">操作</th>
    </thead>
    <tbody>
        @foreach($recruits as $rec)
            <tr>
                <td>{{ $rec->created_at->format('Y年m月d日 H:i') }}</td>
                <td>{{ $rec->title }}</td>
                <td>{{ $rec->status }}</td>
                <td>0人</td>
                <td>
                    <a href="{{ route('recruit.edit', ['id' => $rec->id]) }}" class="btn btn-info">編集</a>
                    <a href="#" class="btn btn-danger">削除</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
@include('layouts.footer')