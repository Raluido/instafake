@extends('layouts.showMessages')

@section('main')
<?php

use App\Models\User;
?>
<section class="message">
    <div class="innerMessage">
        <div class="top">
        </div>
        <div class="bottom">
            <div class="chat">
                @foreach ($messages as $message)
                @if (auth()->id() == $message->sender)
                <div class="userMessageSender">
                    <div class="innerUserMessage">
                        @if(substr($message->content, 0, 4) == "<" . "div" ) <div class="content">
                            <div class="">{!! $message->content !!}</div>
                    </div>
                    @else
                    <div class="content">
                        <div class="text">
                            <p class="">{{ $message->content }}</p>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="createdAt">
                    <h5 class="">{{ FormatTime::LongTimeFilter($message->created_at) }}</h5>
                </div>
            </div>
            @elseif (auth()->id() == $message->receiver)
            <div class="userMessageReceiver">
                <div class="innerUserMessage">
                    @php
                    $user = User::find($message->receiver);
                    @endphp
                    @if($user->avatar)
                    <div class="profile">
                        <img src="{{ route('user.avatar', ['nick' => $nick, 'filename' => $user->image, 'id' => $user->id]) }}" alt="" class="">
                    </div>
                    @else
                    <div class="profile">
                        <img src="{{ Storage::disk('profiles')->url('default/avatar.png') }}" alt="" class="">
                    </div>
                    @endif
                    @if(substr($message->content, 0, 4) == "<" . "div" ) <div class="content">
                        <div class="">{!! $message->content !!}</div>
                </div>
                @else
                <div class="content">
                    <div class="text">
                        <p class="">{{ $message->content }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
        <div class="createdAt">
            <h5 class="">{{ FormatTime::LongTimeFilter($message->created_at) }}</h5>
        </div>
        @endif
        @endforeach
    </div>
    </div>
    <form action="{{ route('messages.send', $nick) }}" method=POST class="">
        @csrf
        <input type="hidden" name="receiver" value="{{ $receiver }}" class="">
        <textarea name="content" id="textarea" wrap="hard" data-min-rows='2' class="replyInput textarea autoExpand"></textarea>
        <input type="submit" id="sendMessageId" value="enviar" class="d-none">
    </form>
    </div>
</section>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/growInput.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/scrollDown.js') }}" defer></script>
<script type="module">
    Echo.private(`chat.${sender}.${receiver}`)
        .listen('NewChatMessage', (e) => {
            console.log(e.content);
        });
</script>
@endsection