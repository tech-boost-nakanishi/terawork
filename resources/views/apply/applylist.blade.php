@extends('layouts.common')
@section('title', $user->name . 'さんの応募一覧 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2 style="margin-bottom: 20px;">{{ $user->name }}さんの応募一覧</h2>

<table class="table table-bordered">
	<thead class="thead-dark">
		<th>求人タイトル</th>
		<th>応募日時</th>
	</thead>
	<tbody>
		@foreach($applylist as $applylists)
			<tr>
				<td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;"><a href="{{ action('RecruitController@show', ['id' => $applylists->recruit->id]) }}">{{ $applylists->recruit->title }}</a></td>
				<td>{{ $applylists->created_at }}</td>
			</tr>
		@endforeach
	</tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $applylist->appends(request()->input())->links() }}
</div>
@endsection
@include('layouts.footer')