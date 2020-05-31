@extends('layouts.common')
@section('title', $user->name . 'さんのプロフィール - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2 style="margin-bottom: 20px;">{{ $user->name }}さんのプロフィール</h2>

@auth('user')
	@if($user->id == Auth::guard('user')->user()->id)
		<a href="{{ action('ApplyController@profileedit', ['id' => $user->id]) }}" class="btn btn-primary float-right" style="width: 90px;">編集する</a>
	@endif
@endauth

<table class="table table-bordered" style="margin-top: 20px;">
	<tr>
		<th class="profile-header" width="20%">資格</th>
		<td>
			@if(!is_null($user->qualification))
				<p class="col-md-10 profile-body">{{ $user->qualification }}</p>
			@else
				<p class="col-md-10 profile-body">未設定です。</p>
			@endif
		</td>
	</tr>
	<tr>
		<th class="profile-header" width="20%">趣味</th>
		<td>
			@if(!is_null($user->hobby))
				<p class="col-md-10 profile-body">{{ $user->hobby }}</p>
			@else
				<p class="col-md-10 profile-body">未設定です。</p>
			@endif
		</td>
	</tr>
	<tr>
		<th class="profile-header" width="20%">自己紹介</th>
		<td>
			@if(!is_null($user->introduction))
				<p class="col-md-10 profile-body">{{ $user->introduction }}</p>
			@else
				<p class="col-md-10 profile-body">未設定です。</p>
			@endif
		</td>
	</tr>
</table>
@endsection
@include('layouts.footer')