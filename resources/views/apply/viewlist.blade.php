@extends('layouts.common')
@section('title', $user->name . 'さんの閲覧履歴 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2 style="margin-bottom: 20px;">{{ $user->name }}さんの閲覧履歴</h2>

<table class="table table-bordered">
	<thead class="thead-dark">
		<th>求人タイトル</th>
		<th>閲覧日時</th>
	</thead>
	<tbody>
		@foreach($viewlist as $viewlists)
			<tr>
				<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="{{ action('RecruitController@show', ['id' => $viewlists->recruit->id]) }}">{{ $viewlists->recruit->title }}</a></td>
				<td>{{ $viewlists->created_at }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $viewlist->appends(request()->input())->links() }}
</div>
@endsection
@include('layouts.footer')