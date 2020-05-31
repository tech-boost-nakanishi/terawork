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
	<form action="{{ action('RecruitController@profileupdate', ['id' => $corporate->id]) }}" method="post" enctype="multipart/form-data">
		<tr>
			<th class="profile-header" width="20%">会社名</th>
			<td>
				<input type="text" class="form-control @error('corporate_name') is-invalid @enderror" name="corporate_name" value="{{ $corporate->corporate_name }}">
				@error('corporate_name')
                    <span style="color: #ff0000;" role="alert">
                        <strong>{{ $errors->first('corporate_name') }}</strong>
                    </span>
                @enderror
			</td>
		</tr>
		<tr>
			<th class="profile-header" width="20%">担当者名</th>
			<td>
				<input type="text" class="form-control @error('contact_name') is-invalid @enderror" name="contact_name" value="{{ $corporate->contact_name }}">
				@error('contact_name')
                    <span style="color: #ff0000;" role="alert">
                        <strong>{{ $errors->first('contact_name') }}</strong>
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
				<input type="text" class="form-control" name="email" value="{{ $corporate->email }}">
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