@extends('layouts.common')
@section('title', $user->name . 'さんのお気に入り一覧 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2 style="margin-bottom: 20px;">{{ $user->name }}さんのお気に入り一覧</h2>

<table class="table table-bordered">
	<thead class="thead-dark">
		<th>求人タイトル</th>
		<th>登録日時</th>
	</thead>
	<tbody>
		@foreach($favoritelist as $favoritelists)
			<tr>
				<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="{{ action('RecruitController@show', ['id' => $favoritelists->recruit->id]) }}">{{ $favoritelists->recruit->title }}</a></td>
				<td>{{ $favoritelists->created_at }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $favoritelist->appends(request()->input())->links() }}
</div>
@endsection
@include('layouts.footer')