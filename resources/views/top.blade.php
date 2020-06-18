@extends('layouts.common')
@section('title', config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')
@if(session('logout'))
    <div class="alert alert-info" role="alert" style="width: 100%;">{{ session('logout') }}</div>
@endif

@if(session('usercancel'))
    <div class="alert alert-info" role="alert" style="width: 100%;">{{ session('usercancel') }}</div>
@endif

@if(session('corporatecancel'))
    <div class="alert alert-info" role="alert" style="width: 100%;">{{ session('corporatecancel') }}</div>
@endif

<h2>求人一覧<span style="font-size: 18px; margin-left: 20px;">{{ $recruits->total() }}件</span><span class="d-none d-sm-block" style="font-size: 18px; font-weight: normal; display: block; text-align: right; margin-top: -20px;">{{ $from }}件〜{{ $to }}件を表示</span></h2>

<div class="card-columns">
    @foreach($recruits as $rec)
        <div class="card mt-3" style="min-width: 280px;">
            <div class="card-header" style="width: 100%; background-color: #d8d8d8; color: #000; font-weight: bold;">
                {{ \Str::limit($rec->title, 30) }}
            </div>
                <div class="card-body">
                <p class="card-text">
                    {{ \Str::limit($rec->body, 50) }}
                </p>
                <table class="table">
                    <tr>
                        <th>都道府県</th>
                        <td>{{ $rec->pref_name }}</td>
                    </tr>
                    <tr>
                        <th>月収</th>
                        <td>約{{ $rec->monthly_income }}万円以上</td>
                    </tr>
                    <tr>
                        <th>言語</th>
                        <td style="width: 65%; word-wrap: break-word;">
                            @foreach($rec->languages as $reclang)
                                <a href="{{ action('RecruitController@languagelist', ['language' => $reclang->name]) }}" style="margin-right: 5px;">{{ $reclang->name }}</a>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
            <a class="btn" href="{{ action('RecruitController@show', ['id' => $rec->id]) }}" style="display: block; margin: 10px auto; margin-top: -10px; width: 100px; background-color: #FFBF00;">詳細を見る</a>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $recruits->appends(request()->input())->links() }}
</div>
@endsection
@include('layouts.footer')