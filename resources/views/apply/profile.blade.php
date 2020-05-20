@extends('layouts.common')
@section('title', $user->name . 'さんのプロフィール - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2>{{ $user->name }}さんのプロフィール</h2>
@endsection
@include('layouts.footer')