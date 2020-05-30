@extends('layouts.common')
@section('title', 'プロフィール編集画面 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

@if(session('profileedited'))
    <div class="alert alert-success" role="alert" style="width: 100%;">{{ session('profileedited') }}</div>
@endif

<h2 style="margin-bottom: 30px;">プロフィール編集画面</h2>

<table class="table table-bordered">
	<form action="{{ action('ApplyController@profileupdate', ['id' => $user->id]) }}" method="post" enctype="multipart/form-data">
		<tr>
			<th class="profile-header" width="20%">名前</th>
			<td>
				<input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
				@error('name')
                    <span style="color: #ff0000;" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @enderror
			</td>
		</tr>
		<tr>
			@if($errors->has('email'))
			　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('email') }}</div>
			@endif
			<th class="profile-header" width="20%">メールアドレス</th>
			<td>
				<input type="text" class="form-control" name="email" value="{{ $user->email }}">
			</td>
		</tr>
		<tr>
			<th class="profile-header" width="20%">資格</th>
			<td>
				<p style="margin: 0; color: #ff0000; font-size: 16px;">（複数ある場合は/で区切ってください。）</p>
				<input type="text" class="form-control" name="qualification" value="{{ $user->qualification }}">
			</td>
		</tr>
		<tr>
			<th class="profile-header" width="20%">趣味</th>
			<td>
				<p style="margin: 0; color: #ff0000; font-size: 16px;">（複数ある場合は/で区切ってください。）</p>
				<input type="text" class="form-control" name="hobby" value="{{ $user->hobby }}">
			</td>
		</tr>
		<tr>
			<th class="profile-header" width="20%">自己紹介</th>
			<td>
				<textarea class="form-control" name="introduction" rows="15">{{ $user->introduction }}</textarea>
			</td>
		</tr>
		<tr>
			<td style="border-color: transparent;"></td>
			<td style="border-color: transparent;">
				{{ csrf_field() }}
    			<input type="submit" value="更新" class="btn btn-primary">
			</td>
		</tr>
	</form>
</table>
@endsection
@include('layouts.footer')