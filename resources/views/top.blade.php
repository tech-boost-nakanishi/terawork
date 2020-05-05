@extends('layouts.common')
@section('title', config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')
@if(session('logout'))
    <div class="alert alert-info" role="alert" style="width: 100%;">{{ session('logout') }}</div>
@endif

<h2>求人一覧(XX件)<span class="d-none d-sm-block" style="font-size: 16px; font-weight: normal; display: block; text-align: right; margin-top: -20px;">xx件〜xx件を表示</span></h2>

<div class="card-columns">
    @for($i=0;$i<6;$i++)
        <div class="card mt-3">
            <div class="card-header" style="width: 100%; background-color: #d8d8d8; color: #000; font-weight: bold;">
                タイトル
            </div>
                <div class="card-body">
                <p class="card-text">
                    ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。ここに本文が入ります。
                </p>
                <table class="table">
                    <tr>
                        <th>都道府県</th>
                        <td>大阪府</td>
                    </tr>
                    <tr>
                        <th>月収</th>
                        <td>30万円以上</td>
                    </tr>
                    <tr>
                        <th>言語</th>
                        <td style="width: 65%; word-wrap: break-word;">PHP Rails Ruby Java Swift</td>
                    </tr>
                </table>
            </div>
            <a class="btn" href="#" style="display: block; margin: 10px auto; margin-top: -10px; width: 100px; background-color: #FFBF00;">詳細を見る</a>
        </div>
    @endfor
</div>
@endsection
@include('layouts.footer')