@extends('layouts.common')
@section('title', '掲載企業一覧 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')

@section('content')

<h2>掲載企業一覧<span style="font-size: 18px; margin-left: 20px;">{{ $corporates->total() }}社</span></h2>

<ul>
@foreach($corporates as $corpo)
    <li style="font-size: 18px; width: 320px; float: left; margin: 5px 0;"><a href="{{ action('RecruitController@profile', ['id' => $corpo->corporate->id]) }}">{{ $corpo->corporate->corporate_name }}</a></li>
@endforeach
</ul>

<div style="clear: both;"></div>

<div class="d-flex justify-content-center">
    {{ $corporates->appends(request()->input())->links() }}
</div>

@endsection

@include('layouts.footer')