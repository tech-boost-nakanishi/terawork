@extends('layouts.common')
@section('title', 'メッセージ管理 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2 style="margin-bottom: 20px;">メッセージ管理</h2>

<table class="table table-bordered">
	<thead class="thead-dark">
		<th>会社名</th>
		<th>タイトル</th>
		<th>メッセージ</th>
	</thead>
	<tbody>
		@foreach($applies as $apply)
			<tr>
				<td><a href="{{ action('RecruitController@profile', ['id' => $apply->recruit->corporate->id]) }}">{{ $apply->recruit->corporate->corporate_name }}</a></td>
				<td><a href="{{ action('RecruitController@show', ['id' => $apply->recruit->id]) }}">{{ $apply->recruit->title }}</a></td>
				<td>
					<a href="{{ action('MessageController@show', ['id' => $apply->id]) }}">
						@if(count($user->sendmessages->where('apply_id', $apply->id)) + count($user->recievemessages->where('apply_id', $apply->id)) > 0)
							メッセージを見る
						@else
							メッセージを送る
						@endif
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $applies->appends(request()->input())->links() }}
</div>
@endsection
@include('layouts.footer')