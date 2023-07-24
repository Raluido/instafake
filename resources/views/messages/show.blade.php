@extends('layouts.showMessages')

@section('main')
<?php

use App\Models\User;
?>
<section class="message">
    <div class="innerMessage">
        <div class="top">
            <h4>Mis mensajes</h4>
        </div>
        <div class="bottom">
            <div class="chat">
                <?php
                foreach ($messages as $message) :
                    if (auth()->id() == $message->sender) :
                ?>
                        <div class="userMessageSender">
                            <div class="innerUserMessage">
                                @php
                                $user = User::find($message->sender);
                                @endphp
                                @if($user->avatar)
                                <div class="profile">
                                    <img src="{{ route('user.avatar', ['nick' => $nick, 'filename' => $message->sender->image, 'id' => $user->id]) }}" alt="" class="">
                                </div>
                                @else
                                <div class="profile">
                                    <img src="{{ Storage::disk('images')->url('default/avatar.png') }}" alt="" class="">
                                </div>
                                @endif
                                <div class="content">
                                    @if(substr($message->content, 0, 4) == "<div")
                                    <div class="">{!! $message->content !!}</div>
                                    @else
                                    <div class="">{{ $message->content }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h5 class="">{{ FormatTime::LongTimeFilter($message->created_at) }}</h5>
                        </div>
                    <?php
                    elseif (auth()->id() == $message->receiver) :
                    ?>
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
                                    <img src="{{ Storage::disk('images')->url('default/avatar.png') }}" alt="" class="">
                                </div>
                                @endif
                                <div class="content">
                                @if(substr($message->content, 0, 4) == "<div")
                                    <div class="">{!! $message->content !!}</div>
                                    @else
                                    <div class="">{{ $message->content }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <h5 class="">{{ FormatTime::LongTimeFilter($message->created_at) }}</h5>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
            <form action="{{ route('messages.send', $nick) }}" method=POST class="">
                @csrf
                <input type="hidden" name="receiver" value="{{ $receiver }}" class="">
                <textarea name="content" id="textarea" wrap="hard" data-min-rows='2' class="replyInput textarea autoExpand"></textarea>
                <input type="submit" id="sendMessageId" value="enviar" class="d-none">
            </form>
        </div>
    </div>
</section>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/growInput.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/scrollDown.js') }}" defer></script>
@endsection