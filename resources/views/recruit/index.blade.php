@extends('layouts.common')
@section('title', $recruit->title . ' - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')

@section('content')
@if(session('recruitcreate'))
    <div class="alert alert-success" role="alert" style="width: 100%;">{{ session('recruitcreate') }}</div>
@endif

@if(session('favadded'))
    <div class="alert alert-success" role="alert" style="width: 100%;">{{ session('favadded') }}</div>
@endif

@if(session('favexists'))
    <div class="alert alert-danger" role="alert" style="width: 100%;">{{ session('favexists') }}</div>
@endif

<h2 style="font-size: 26px;">{{ $recruit->title }}</h2>

<h4 style="margin-top: 30px;">{{ $recruit->corporate->corporate_name }}</h4>
<p style="font-size: 16px;">担当：{{ $recruit->corporate->contact_name }}</p>

<table class="table table-bordered">
    <tr>
        <th class="bg-light" width="20%">都道府県</th>
        <td>{{ $recruit->pref_name }}</td>
    </tr>
    <tr>
        <th class="bg-light">月収</th>
        <td>約{{ $recruit->monthly_income }}万円以上</td>
    </tr>
    <tr>
        <th class="bg-light">言語</th>
        <td>
            @foreach($recruit->languages as $reclang)
                <a href="#" style="margin-right: 5px;">{{ $reclang->name }}</a>
            @endforeach
        </td>
    </tr>
</table>

<h4 style="font-weight: bold; margin-bottom: 10px;">本文</h4>
<p style="font-size: 16px;">{{ $recruit->body }}</p>

<div style="width: 320px; display: flex; justify-content: space-between; margin: 0 auto; margin-top: 50px;">
    <a href="{{ action('ApplyController@favorite', ['id' => $recruit->id]) }}" class="btn btn-info btn-lg @if(!Auth::guard('user')->user()) disabled @endif" style="color: #fff;">お気に入りに追加</a>
    <a href="{{ action('ApplyController@pre_apply', ['id' => $recruit->id]) }}" class="btn btn-lg btn-primary @if(!Auth::guard('user')->user()) disabled @endif">応募する</a>
</div>

@endsection

@include('layouts.footer')