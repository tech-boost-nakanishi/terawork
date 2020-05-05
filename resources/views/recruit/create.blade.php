@extends('layouts.common')
@section('title', '求人投稿画面 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')

@section('content')
<h2>求人投稿画面</h2>

<form action="{{ action('RecruitController@create') }}" method="post" enctype="multipart/form-data">
	<div class="form-group row">
        <label class="col-md-12" for="title">タイトル</label>
        <div class="col-md-12">
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-12" for="monthly_income">月収</label>
        <div class="col-md-12">
            <p style="float: left;">約</p>
            <input type="number" class="form-control" name="monthly_income" value="{{ old('monthly_income') }}" style="margin: 0 10px; margin-top: -5px; float: left; width: 100px;">
        	<p style="float: left;">万円以上</p>
        	<div style="clear: both;"></div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-12" for="languages">言語</label>
        <div class="col-md-12">
        	@foreach($languages as $lang)
            	<input type="checkbox" class="form-control" name="languages[]" value="{{ $lang->id }}" multiple style="display: inline-block; width: 25px;"><span style="padding-top: -10px;">{{ $lang->name }}</span>
            @endforeach
        </div>
    </div>
    <div class="form-group row">
        <label class="col-md-12" for="body">本文</label>
        <div class="col-md-12">
            <textarea class="form-control" name="body" rows="15">{{ old('body') }}</textarea>
        </div>
    </div>
</form>
@endsection

@include('layouts.footer')