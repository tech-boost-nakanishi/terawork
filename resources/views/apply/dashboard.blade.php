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

<h2 style="margin-bottom: 20px;">応募者マイページ</h2>

<div style="width: 100%;">
	<h5 style="font-weight: bold;">応募履歴</h5>
	<table class="table table-bordered">
		<thead class="thead-dark">
			<th>求人タイトル</th>
			<th>応募日時</th>
		</thead>
		<tbody>
			@foreach($applyrecs as $applyrec)
				<tr>
					<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="{{ action('RecruitController@show', ['id' => $applyrec->id]) }}">{{ $applyrec->recruit->title }}</a></td>
					<td>{{ $applyrec->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<a href="{{ action('ApplyController@applylist', ['id' => Auth::guard('user')->user()->id]) }}" style="float: right;">もっと見る</a>
</div>

<div style="clear: both;"></div>

<div style="width: 100%;">
	<h5 style="font-weight: bold;">閲覧履歴</h5>
	<table class="table table-bordered">
		<thead class="thead-dark">
			<th>求人タイトル</th>
			<th>閲覧日時</th>
		</thead>
		<tbody>
			@foreach($viewrecs as $viewrec)
				<tr>
					<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="{{ action('RecruitController@show', ['id' => $viewrec->id]) }}">{{ $viewrec->recruit->title }}</a></td>
					<td>{{ $viewrec->updated_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<a href="{{ action('ApplyController@viewlist', ['id' => Auth::guard('user')->user()->id]) }}" style="float: right;">もっと見る</a>
</div>

<div style="clear: both;"></div>

<div style="width: 100%;">
	<h5 style="font-weight: bold;">お気に入り一覧</h5>
	<table class="table table-bordered">
		<thead class="thead-dark">
			<th>求人タイトル</th>
			<th>登録日時</th>
		</thead>
		<tbody>
			@foreach($favrecs as $favrec)
				<tr>
					<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="{{ action('RecruitController@show', ['id' => $favrec->id]) }}">{{ $favrec->recruit->title }}</a></td>
					<td>{{ $favrec->created_at }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<a href="{{ action('ApplyController@favoritelist', ['id' => Auth::guard('user')->user()->id]) }}" style="float: right;">もっと見る</a>
</div>
<div style="clear: both;"></div>

<a href="{{ action('ApplyController@pre_cancel', ['id' => Auth::guard('user')->user()->id]) }}" class="btn btn-danger float-right mt-4">退会する</a>

@endsection
@include('layouts.footer')