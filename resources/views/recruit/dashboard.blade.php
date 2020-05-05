@extends('layouts.common')
@section('title', 'マイページ - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')
@if(session('register'))
    <div class="alert alert-info" role="alert" style="width: 100%;">{{ session('register') }}</div>
@endif

@if(session('login'))
    <div class="alert alert-info" role="alert" style="width: 100%;">{{ session('login') }}</div>
@endif

<h2>掲載者マイページ</h2>

@endsection
@include('layouts.footer')