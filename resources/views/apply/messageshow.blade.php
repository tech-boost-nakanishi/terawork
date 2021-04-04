@extends('layouts.common')
@section('title', 'メッセージ管理 - ' . config('app.name'))

@include('layouts.header')
@include('layouts.sidebar')
@section('content')

<h2 style="margin-bottom: 20px;">{{ $apply->recruit->corporate->corporate_name }}さんとのメッセージ</h2>
<p style="font-size: 18px;"><strong>応募求人</strong>：<a href="{{ action('RecruitController@show', ['id' => $apply->recruit->id]) }}">{{ $apply->recruit->title }}</a></p>

@if(count($messages) > 0)
	@foreach($messages as $message)
		@if(!is_null($message->send_user_id))
			<div class="send-messagebox messagebox" @if($loop->last)id="latest-message"@endif>
				<div>
					<p class="messagebox-sender">あなた</p>
					<p class="messagebox-subject">{{ $message->subject }}</p>
				</div>
				<hr>
				<div>
					<p class="messagebox-body">{{ $message->body }}</p>
				</div>
			</div>
			<span class="send-messagebox-date messagebox-date">{{ $message->created_at }}  @if($message->readed == 1)既読@endif</span>

		@else
			<div class="recieve-messagebox messagebox" @if($loop->last)id="latest-message"@endif>
				<div>
					<p class="messagebox-sender">
						{{ $apply->recruit->corporate->corporate_name }}
					</p>
					<p class="messagebox-subject">{{ $message->subject }}</p>
				</div>
				<hr>
				<div>
					<p class="messagebox-body">{{ $message->body }}</p>
				</div>
			</div>
			<span class="recieve-messagebox-date messagebox-date">{{ $message->created_at }}</span>
		@endif
	@endforeach
@else
	<p style="font-weight: bold; font-size: 18px;">メッセージはまだありません。</p>
@endif

<h3 style="clear: both;">メッセージを送信</h3>
<form action="{{ action('MessageController@usercreate', ['id' => $apply->id]) }}" method="post" enctype="multipart/form-data">
	<div class="form-group row">
		@if($errors->has('subject'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('subject') }}</div>
		@endif
        <label class="col-md-12" for="subject">件名</label>
        <div class="col-md-12">
            <input type="text" class="form-control" name="subject" value="@if(!is_null($subject))Re:@endif{{ $subject }}">
        </div>
	</div>
	<div class="form-group row">
		@if($errors->has('body'))
		　　<div class="alert alert-danger" role="alert" style="width: 100%;">{{ $errors->first('body') }}</div>
		@endif
        <label class="col-md-12" for="body">本文</label>
        <div class="col-md-12">
            <textarea class="form-control" name="body" rows="5">{{ old('body') }}</textarea>
        </div>
	</div>
	{{ csrf_field() }}
    <input type="submit" value="メッセージ送信" class="btn btn-primary" style="display: block; width: 140px; margin: 20px auto;">
</form>


<!-- <script src="{{ asset('js/message.js') }}" defer></script> -->
<script type="text/javascript">
	$(function(){
		var position = $('#latest-message').offset().top;
		$('html, body').animate({scrollTop:position}, 300);
	});
</script>
@endsection
@include('layouts.footer')