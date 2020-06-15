@extends('layouts.common')
@section('title', $language . 'の求人一覧 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2>{{ $language }}の求人一覧<span style="font-size: 18px; margin-left: 20px;">{{ count($recruit) }}件</span><span class="d-none d-sm-block" style="font-size: 18px; font-weight: normal; display: block; text-align: right; margin-top: -20px;">{{ $from }}件〜{{ $to }}件を表示</span></h2>

@if(count($recruits) > 0)
    <div class="card-columns">
        @foreach($recruits as $recruit)
            <div class="card mt-3" style="min-width: 280px;">
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
                                @foreach($recruit->languages as $reclang)
                                    <a href="{{ action('RecruitController@languagelist', ['language' => $reclang->name]) }}" style="margin-right: 5px;">{{ $reclang->name }}</a>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                <a class="btn" href="{{ action('RecruitController@show', ['id' => $recruit->id]) }}" style="display: block; margin: 10px auto; margin-top: -10px; width: 100px; background-color: #FFBF00;">詳細を見る</a>
            </div>
        @endforeach
    </div>


    <div class="d-flex justify-content-center">
        {{ $recruits->appends(request()->input())->links() }}
    </div>
@else
    <p>{{ $language }}の求人はありません。</p>
@endif
@endsection
@include('layouts.footer')