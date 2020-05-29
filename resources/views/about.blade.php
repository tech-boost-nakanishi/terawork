@extends('layouts.common')
@section('title', config('app.name') . 'について')

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2 style="margin-bottom: 30px;">{{ config('app.name') }}について</h2>

<p style="font-size: 18px;">
    本サイトはエンジニアに特化した求人サイトです。<br>
    @guest
        応募や掲載には会員登録が必要です。<br>
        会員登録がお済みでない方は以下より登録をしてください。<br>
        ・求人を掲載したい方は<a href="{{ url('corporate/register') }}">こちら</a><br>
        ・求人に応募したい方は<a href="{{ url('register') }}">こちら</a>
    @endguest
</p>
@endsection
@include('layouts.footer')