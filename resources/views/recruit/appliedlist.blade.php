@extends('layouts.common')
@section('title', '応募者一覧 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2>応募者一覧</h2>

<p style="font-size: 18px; margin-top: 20px;"><strong>応募求人</strong>：<a href="{{ action('RecruitController@show', ['id' => $recruit->id]) }}">{{ $recruit->title }}</a></p>
<table class="table table-bordered" style="margin-top: 20px;">
    <thead class="thead-dark">
        <th>応募者</th>
        <th>メッセージ</th>
    </thead>
    <tbody>
        @foreach($applies as $apply)
            <tr>
                <td>
                    <a href="{{ action('ApplyController@profile', ['id' => $apply->user->id]) }}">
                        {{ $apply->user->name }}
                    </a>
                </td>
                <td>
                    <a href="{{ action('MessageController@corporateshow', ['id' => $apply->id]) }}">
                        @if(count($apply->recruit->corporate->sendmessages->where('apply_id', $apply->id)) + count($apply->recruit->corporate->recievemessages->where('apply_id', $apply->id)) > 0)
                            メッセージを見る
                        @else
                            メッセージを送る
                        @endif
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $applies->appends(request()->input())->links() }}
</div>

@endsection
@include('layouts.footer')