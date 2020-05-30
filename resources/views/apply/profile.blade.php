@extends('layouts.common')
@section('title', $user->name . 'さんのプロフィール - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2>{{ $user->name }}さんのプロフィール</h2>

<a href="{{ action('ApplyController@profileedit', ['id' => Auth::guard('user')->user()->id]) }}" class="btn btn-primary float-right" style="margin: 20px 0; width: 90px;">編集する</a>

<table class="table table-bordered">
	<tr>
		<th class="profile-header" width="20%">名前</th>
		<td>
			@if(!is_null(Auth::guard('user')->user()->name))
				<p class="col-md-10 profile-body">{{ Auth::guard('user')->user()->name }}</p>
			@else
				<p class="col-md-10 profile-body">未設定です。</p>
			@endif
		</td>
	</tr>
	<tr>
		<th class="profile-header" width="20%">メールアドレス</th>
		<td>
			@if(!is_null(Auth::guard('user')->user()->email))
				<p class="col-md-10 profile-body">{{ Auth::guard('user')->user()->email }}</p>
			@else
				<p class="col-md-10 profile-body">未設定です。</p>
			@endif
		</td>
	</tr>
	<tr>
		<th class="profile-header" width="20%">資格</th>
		<td>
			@if(!is_null(Auth::guard('user')->user()->qualification))
				<p class="col-md-10 profile-body">{{ Auth::guard('user')->user()->qualification }}</p>
			@else
				<p class="col-md-10 profile-body">未設定です。</p>
			@endif
		</td>
	</tr>
	<tr>
		<th class="profile-header" width="20%">趣味</th>
		<td>
			@if(!is_null(Auth::guard('user')->user()->hobby))
				<p class="col-md-10 profile-body">{{ Auth::guard('user')->user()->hobby }}</p>
			@else
				<p class="col-md-10 profile-body">未設定です。</p>
			@endif
		</td>
	</tr>
	<tr>
		<th class="profile-header" width="20%">自己紹介</th>
		<td>
			@if(!is_null(Auth::guard('user')->user()->introduction))
				<p class="col-md-10 profile-body">{{ Auth::guard('user')->user()->introduction }}</p>
			@else
				<p class="col-md-10 profile-body">未設定です。</p>
			@endif
		</td>
	</tr>
</table>
@endsection
@include('layouts.footer')