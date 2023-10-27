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
            <div class="chat" id="chatContainer">
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
                    $user = User::find($message->sender);
                    @endphp
                    <div class="profile">
                        <img src="{{ route('user.avatar', ['nick' => $nick, 'filename' => $user->image, 'id' => $user->id]) }}" alt="" class="">
                    </div>
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
        <input type="hidden" name="receiver" id="receiver" value="{{ $receiver }}" class="">
        <input type="hidden" name="sender" id="sender" value="{{ auth()->id() }}" class="">
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
    window.onload = function() {
        let url = <?php env('APP_URL') ?>
        let sender = document.getElementById('receiver').value;
        let receiver = document.getElementById('sender').value;
        let chatContainer = document.getElementById('chatContainer');
        Echo.private(`chat.${sender}.${receiver}`)
            .listen('NewChatMessage', (e) => {
                let userMessageReceiverContainer = document.createElement('div');
                userMessageReceiverContainer.setAttribute('class', 'userMessageReceiver');
                let innerUserMessageContainer = document.createElement('div');
                innerUserMessageContainer.setAttribute('class', 'innerUserMessage');
                let profileContainer = document.createElement('div');
                profileContainer.setAttribute('class', 'profile');
                let contentContainer = document.createElement('div');
                contentContainer.setAttribute('class', 'content');
                let imgContainer = document.createElement('img');
                imgContainer.setAttribute('src', url + '/show/' + e.filename + '/' + receiver);
                let textContainer = document.createElement('div');
                textContainer.setAttribute('class', 'text');
                let paragraph = document.createElement('p');
                chatContainer.appendChild(userMessageReceiverContainer);
                userMessageReceiverContainer.appendChild(innerUserMessageContainer);
                innerUserMessageContainer.appendChild(profileContainer);
                profileContainer.appendChild(imgContainer);
                innerUserMessageContainer.appendChild(contentContainer);
                contentContainer.appendChild(textContainer);
                textContainer.appendChild(paragraph);
                paragraph.innerHTML = e.message;
            });
    }
</script>
@endsection