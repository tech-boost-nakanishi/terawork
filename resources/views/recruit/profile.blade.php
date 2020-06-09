@extends('layouts.common')
@section('title', $corporate->corporate_name . 'さんのプロフィール - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2 style="margin-bottom: 20px;">{{ $corporate->corporate_name }}さんのプロフィール</h2>

@auth('corporate')
	@if($corporate->id == Auth::guard('corporate')->user()->id)
		<a href="{{ action('RecruitController@profileedit', ['id' => $corporate->id]) }}" class="btn btn-primary float-right" style="width: 90px; margin-left: 20px;">編集する</a>
		<a href="{{ url('corporate/changepassword') }}" class="btn btn-info float-right" style="width: 130px;">パスワード変更</a>
	@endif
@endauth

<table class="table table-bordered" style="margin-top: 20px;">
	<tr>
		<th class="profile-header" width="20%">会社名</th>
		<td>
			<p class="col-md-10 profile-body">{{ $corporate->corporate_name }}</p>
		</td>
	</tr>
	<tr>
		<th class="profile-header" width="20%">担当者名</th>
		<td>
			<p class="col-md-10 profile-body">{{ $corporate->contact_name }}</p>
		</td>
	</tr>
</table>
@endsection
@include('layouts.footer')