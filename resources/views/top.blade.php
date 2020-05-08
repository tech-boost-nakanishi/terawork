@extends('layouts.common')
@section('title', config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')
@if(session('logout'))
    <div class="alert alert-info" role="alert" style="width: 100%;">{{ session('logout') }}</div>
@endif

<h2>求人一覧<span style="font-size: 18px; margin-left: 20px;">{{ count($recruits) }}件</span><span class="d-none d-sm-block" style="font-size: 18px; font-weight: normal; display: block; text-align: right; margin-top: -20px;">xx件〜xx件を表示</span></h2>

<div class="card-columns">
    @foreach($recruits as $recruit)
        <div class="card mt-3">
            <div class="card-header" style="width: 100%; background-color: #d8d8d8; color: #000; font-weight: bold;">
                {{ \Str::limit($recruit->title, 30) }}
            </div>
                <div class="card-body">
                <p class="card-text">
                    {{ \Str::limit($recruit->body, 50) }}
                </p>
                <table class="table">
                    <tr>
                        <th>都道府県</th>
                        <td>{{ $recruit->pref_name }}</td>
                    </tr>
                    <tr>
                        <th>月収</th>
                        <td>約{{ $recruit->monthly_income }}万円以上</td>
                    </tr>
                    <tr>
                        <th>言語</th>
                        <td style="width: 65%; word-wrap: break-word;">
                            @foreach($recruit->recruitlanguages as $reclang)
                                <p>{{ $reclang->name }}</p>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </div>
            <a class="btn" href="#" style="display: block; margin: 10px auto; margin-top: -10px; width: 100px; background-color: #FFBF00;">詳細を見る</a>
        </div>
    @endforeach
</div>

<div class="d-flex justify-content-center">
    {{ $recruits->appends(request()->input())->links() }}
</div>
@endsection
@include('layouts.footer')